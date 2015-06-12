<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 12:49
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact;


use AGmakonts\STL\AbstractValueObject;
use AGmakonts\STL\String\String;
use Famillio\Domain\Family\ValueObject\Gender;

/**
 * Class Story
 *
 * @package Famillio\Domain\Famillio\ValueObject\Biography\Fact
 */
class Story extends AbstractValueObject
{

    private $present;

    private $past;

    private $future;

    private $previous;

    private $gender;

    /**
     * @param \AGmakonts\STL\String\String                             $past
     * @param \AGmakonts\STL\String\String                             $present
     * @param \AGmakonts\STL\String\String                             $future
     * @param \Famillio\Domain\Family\ValueObject\Gender|NULL          $genderTarget
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Story $previous
     *
     * @internal param \Famillio\Domain\Famillio\ValueObject\Biography\Fact\Story|NULL $original
     */
    static public function get(String $past,
                               String $present,
                               String $future,
                               Gender $genderTarget = NULL,
                               Story $previous = NULL) : Story
    {
        $original = self::extractedOriginal($previous);


    }

    /**
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Story $story
     *
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
    static private function extractedOriginal(Story $story = NULL) : Story
    {
        $original = NULL;

        if (NULL !== $story && NULL !== $story->previousVersion()) {
            $original = self::extractedOriginal($story->previousVersion());
        } else {
            $original = $story;
        }

        return $original;

    }


    public function present() : String
    {

    }

    public function past() : String
    {

    }

    public function future() : String
    {

    }

    public function allTenses() : \SplObjectStorage
    {

    }

    public function genderTargeted(Gender $gender) : Story
    {

    }

    public function previousVersion() : Story
    {
        return $this->previous;
    }

    /**
     * @param array $value
     *
     */
    protected function __construct(array $value)
    {
    }

    /**
     * @return mixed
     */
    public function value()
    {
    }

    /**
     * @return string
     */
    public function __toString()
    {
    }

    /**
     * @return string
     */
    public function extractedValue()
    {
    }

}