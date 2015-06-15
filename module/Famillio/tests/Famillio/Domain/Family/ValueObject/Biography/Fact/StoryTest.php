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
     */
    public function testExtractedOriginal()
    {
        $story = $this->simpleStory('test 1');

        $reflection = new \ReflectionClass(Story::class);

        $method = $reflection->getMethod('extractedOriginal');
        $method->setAccessible(TRUE);


    }

    /**
     * @return array
     */
    public function leveledStoryProvider() : array
    {
        return [
            [
                $this->simpleStory('test 2'),
                $this->simpleStory('test 2')
            ],
            [
                $this->simpleStory('test 3', $this->simpleStory('test 4')),
                $this->simpleStory('test 4')
            ]
        ];
    }




}
