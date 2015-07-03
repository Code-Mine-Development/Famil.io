<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 13/06/15
 * Time: 15:13
 */

namespace Famillio\Model\Person\ValueObject\Biography\Fact;

use AGmakonts\STL\String\Text;
use AGmakonts\STL\Structure\KeyValuePair;
use Famillio\Model\Person\ValueObject\Biography\Fact\Exception\CorruptedTokensException;
use Famillio\Model\Person\ValueObject\Biography\Fact\Exception\IncompatibleStoryDataException;

/**
 * Class StoryTest
 *
 * @package Famillio\Model\Person\ValueObject\Biography\Fact
 * @coversDefaultClass \Famillio\Model\Person\ValueObject\Biography\Fact\Story
 */
class StoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return \Famillio\Model\Person\ValueObject\Biography\Fact\Story
     */
    private function simpleStory($name, Story $previous = NULL) : Story
    {
        $story = Story::get(
            Text::get($name . ' - Was born at {DATE} in {LOCATION}'),
            Text::get($name . ' - Is borning at {DATE} in {LOCATION}'),
            Text::get($name . ' - Will be born in {LOCATION} at {DATE}'),
            [
                KeyValuePair::get(Text::get('{LOCATION}'), Text::get($name . ' - Gliwice')),
                KeyValuePair::get(Text::get('{DATE}'), Text::get($name . ' - 24-03-03')),
            ],
            NULL,
            $previous
        );

        return $story;
    }

    /**
     * @covers ::extractedOriginal
     * @dataProvider leveledStoryProvider
     *
     * @param \Famillio\Model\Person\ValueObject\Biography\Fact\Story $test
     * @param \Famillio\Model\Person\ValueObject\Biography\Fact\Story $expected
     */
    public function testExtractedOriginal(Story $test, Story $expected)
    {
        $reflection = new \ReflectionClass(Story::class);
        $story      = $this->simpleStory('test 1');


        $method = $reflection->getMethod('extractedOriginal');
        $method->setAccessible(TRUE);

        $result = $method->invoke($story, $test);

        $this->assertSame($expected, $result);
        $this->assertEquals($expected, $result);
        $this->assertInstanceOf(Story::class, $result);

    }

    /**
     * @covers ::tokenDifferences
     * @covers ::mergeTokens
     * @covers ::validateTokenUsage
     *
     * @dataProvider storyTokenDifferenceProvider
     *
     * @param \AGmakonts\STL\String\Text $past
     * @param \AGmakonts\STL\String\Text $present
     * @param \AGmakonts\STL\String\Text $future
     * @param array                      $data
     * @param                            $valid
     */
    public function testTokenDifferencesHandling(Text $past, Text $present, Text $future, array $data, $valid)
    {
        if(FALSE === $valid) {
            $this->setExpectedException(IncompatibleStoryDataException::class);
        }

        $story = Story::get($past, $present, $future, $data);

        if(TRUE === $valid) {
            $this->assertInstanceOf(Story::class, $story);
        }
    }

    /**
     * @covers ::validateTokenUsage
     * @covers ::areTokensValid
     * @dataProvider tokenValidationTestProvider
     *
     * @param \AGmakonts\STL\Structure\KeyValuePair $pair
     * @param bool                                  $valid
     */
    public function testTokenValidation(KeyValuePair $pair, $valid)
    {
        $string = Text::get('Test data');

        if(FALSE === $valid) {
            $this->setExpectedException(CorruptedTokensException::class);

        }

        $story = Story::get(
            $string,
            $string,
            $string,
            [
                $pair
            ]
        );

        if(TRUE === $valid) {
            $this->assertInstanceOf(Story::class, $story);
        }


    }

    /**
     * @return array
     */
    public function tokenValidationTestProvider() : array
    {
        $tokens = [
            ['{TOKEN', FALSE],
            ['TOKEN}', FALSE],
            ['TOKEN' , FALSE],
            ['12232', FALSE],
            ['{}', FALSE],
            ['{token}', FALSE],
            ['{TOKEn{', FALSE],
            ['{TOKEn}', FALSE],
            ['{TOKEN122}', FALSE],
            ['{TOKEN}', TRUE],
            ['{TOKEN TOKEN}', FALSE]

        ];

        $keyValuePairs = [];

        foreach ($tokens as $token) {
            $keyValuePairs[] = [
                KeyValuePair::get(Text::get($token[0]), Text::get('Data')),
                $token[1]
            ];
        }

        return $keyValuePairs;
    }

    /**
     * @return array
     */
    public function storyTokenDifferenceProvider() : array
    {
        return [
            [

                Text::get(' - Was born at {DATE} in {LOCATION}'),
                Text::get(' - Is borning at {DATE} in {LOCATION}'),
                Text::get(' - Will be born in {LOCATION} at {DATE}'),
                [
                    KeyValuePair::get(Text::get('{LOCATION}'), Text::get('Gliwice')),
                    KeyValuePair::get(Text::get('{DATE}'), Text::get('24-03-03')),
                ],
                TRUE,
            ],
            [

                Text::get(' - Was born at {DATE} in {LOCATION}'),
                Text::get(' - Is borning at {DATE} in {LOCATION}'),
                Text::get(' - Will be born in {LOCATION} at {DATE}'),
                [
                    KeyValuePair::get(Text::get('{DATE}'), Text::get('24-03-03')),
                ],
                FALSE,
            ],
            [
                Text::get(' - Was born at {DATE} in {LOCATION}'),
                Text::get(' - Is borning in {LOCATION}'),
                Text::get(' - Will be born in {LOCATION}'),
                [
                    KeyValuePair::get(Text::get('{LOCATION}'), Text::get('Gliwice')),
                    KeyValuePair::get(Text::get('{DATE}'), Text::get('24-03-03')),
                ],
                TRUE,
            ],

        ];
    }

    /**
     * @return array
     */
    public function leveledStoryProvider() : array
    {
        return [
            [
                $this->simpleStory('test 2'),
                $this->simpleStory('test 2'),
            ],
            [
                $this->simpleStory('test 3', $this->simpleStory('test 4')),
                $this->simpleStory('test 4'),
            ],
            [
                $this->simpleStory('test 5', $this->simpleStory('test 6', $this->simpleStory('test 7'))),
                $this->simpleStory('test 7'),
            ],
        ];
    }


}
