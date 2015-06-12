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
use Famillio\Domain\Family\ValueObject\Biography\Fact\Exception\InvalidTokenException;
use Famillio\Domain\Family\ValueObject\Gender;
use Zend\Validator\Regex;
use Zend\Validator\ValidatorChain;

/**
 * Class Story
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact
 */
class Story extends AbstractValueObject
{

    private $present;

    private $past;

    private $future;

    private $previous;

    private $gender;

    private $data;


    /**
     * @param \AGmakonts\STL\String\String                                  $past
     * @param \AGmakonts\STL\String\String                                  $present
     * @param \AGmakonts\STL\String\String                                  $future
     * @param array                                                         $data
     * @param \Famillio\Domain\Family\ValueObject\Gender|NULL               $genderTarget
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Story|NULL $previous
     *
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
    static public function get(String $past,
                               String $present,
                               String $future,
                               array $data,
                               Gender $genderTarget = NULL,
                               Story $previous = NULL) : Story
    {
        $original = self::extractedOriginal($previous);

        return self::getInstanceForValue([
                                             $past,
                                             $present,
                                             $future,
                                             $data,
                                             $genderTarget,
                                             $original,
                                         ]);
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


    /**
     * @return \AGmakonts\STL\String\String
     */
    public function rawPresent() : String
    {
        return $this->present;
    }

    /**
     * @return \AGmakonts\STL\String\String
     */
    public function rawPast() : String
    {
        return $this->past;
    }

    /**
     * @return \AGmakonts\STL\String\String
     */
    public function rawFuture() : String
    {
        return $this->future;
    }

    /**
     * @param \Famillio\Domain\Family\ValueObject\Gender $gender
     *
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
    public function genderTargeted(Gender $gender) : Story
    {
        return self::get($this->past(), $this->present(), $this->future(), $gender, $this);
    }

    /**
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
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
        list($past, $present, $future, $data, $gender, $original) = $value;

        $this->past     = $past;
        $this->present  = $present;
        $this->future   = $future;
        $this->gender   = $gender;
        $this->data     = $data;
        $this->previous = $original;
    }

    private function isDataValid(array $data)
    {
        $validatorChain = new ValidatorChain();

        $validatorChain->attach(new Regex('/^\{[A-Z]+\}$/'));

        foreach($data as $token => $value) {
            if(FALSE === $validatorChain->isValid($token)) {
                throw new InvalidTokenException($token);
            }
        }
    }

    private function listTokens(array $data)
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