<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 13/06/15
 * Time: 15:13
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact;
use AGmakonts\STL\String\Text;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Class StoryTest
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact
 * @coversDefaultClass \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
 */
class StoryTest extends \PHPUnit_Framework_TestCase
{

    private function textMock($string) : PHPUnit_Framework_MockObject_MockObject
    {
        $mockBuilder = $this->getMockBuilder(Text::class);
        $mockBuilder->disableProxyingToOriginalMethods()
                    ->disableOriginalConstructor()
                    ->disableOriginalClone();

        $mock = $mockBuilder->getMock();
        $mock->expects($this->any())->method('value')->willReturn($string);

        return $mock;
    }

    private function keyValuePairMock($key, $val) : PHPUnit_Framework_MockObject_MockObject
    {

    }

    /**
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
    private function simpleStory(Story $previous = NULL) : Story
    {
        $story = Story::get(
            $this->textMock('Was born at {DATE} in {LOACATION}'),
            $this->textMock('Is borning at {DATE} in {LOCATION}'),
            $this->textMock('Will be born in {LOCATION} at {DATE}'),
            [
                '{DATE}'     => '29-02-02',
                '{LOCATION}' => 'Gliwice'
            ],
            NULL,
            $previous
        );

        return $story;
    }

    /**
     * @covers ::extractedOriginal
     */
    public function testObjectCreation()
    {
        $story = $this->simpleStory();
    }


}
