<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 13/06/15
 * Time: 15:13
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact;

use AGmakonts\STL\String\Text;
use AGmakonts\STL\Structure\KeyValuePair;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Exception\IncompatibleStoryDataException;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Providers\LeveledStoryProvider;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Class StoryTest
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact
 * @coversDefaultClass \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
 */
class StoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
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
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Story $test
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Story $expected
     */
    public function testExtractedOriginal(Story $test, Story $expected)
    {
        $reflection = new \ReflectionClass(Story::class);
        $story      = $this->simpleStory('test 1');


        $method = $reflection->getMethod('extractedOriginal');
        $method->setAccessible(TRUE);

        $result = $method->invoke($story, $test);

        $this->assertSame($expected, $result);

    }

    /**
     * @covers ::tokenDifferences
     * @covers ::mergeTokens
     * @covers ::validateTokenUsage
     *
     * @dataProvider storyTokenDifferenceProvider
     */
    public function testTokenDifferencesHandling(Text $past, Text $present, Text $future, array $data, $valid)
    {
        if(FALSE === $valid) {
            $this->setExpectedException(IncompatibleStoryDataException::class);
        }

        $story = Story::get($past, $present, $future, $data);
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
