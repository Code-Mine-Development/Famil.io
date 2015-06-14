<?php
/**
 * Date:   11/06/15
 * Time:   15:05
 * 
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact;


use AGmakonts\STL\AbstractValueObject;
use AGmakonts\STL\String\Text;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Exception\InvalidDescriptionException;

/**
 * Class Description
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact
 */
class Description extends AbstractValueObject
{
    private $description;


    /**
     * @param \AGmakonts\STL\String\Text $contents
     *
     * @return mixed
     */
    static public function get(Text $contents) : Description
    {
        return self::getInstanceForValue([$contents]);
    }

    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function contents() : Text
    {
        return $this->description;
    }

    /**
     * @param array $value
     *
     */
    protected function __construct(array $value)
    {
        /** @var \AGmakonts\STL\String\Text $contents */
        $contents = $value[0];


        if(TRUE === ctype_space($contents->value()) ||
           TRUE === $contents->length()->isZero()) {

            throw new InvalidDescriptionException();
        }
    }

    /**
     * @return string
     */
    public function value()
    {
        return $this->contents()->value();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value();
    }

    /**
     * @return string
     */
    public function extractedValue()
    {
        return self::extractValue([$this->description]);
    }

}