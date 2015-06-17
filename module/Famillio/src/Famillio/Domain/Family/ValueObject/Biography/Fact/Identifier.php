<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 17:25
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact;


use AGmakonts\STL\AbstractValueObject;
use AGmakonts\STL\DateTime\DateTime;
use AGmakonts\STL\String\Text;

/**
 * Class Identifier
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact
 */
class Identifier extends AbstractValueObject
{
    private $identifier;

    private $date;


    static public function get(Text $identifier) : Identifier
    {

    }

    /**
     * @param \AGmakonts\STL\DateTime\DateTime $dateTime
     */
    static public function generate(DateTime $dateTime) : Identifier
    {

    }

    public function date() : DateTime
    {
        return $this->date;
    }

    /**
     * @param array $value
     *
     */
    protected function __construct(array $value)
    {
        // TODO: Implement __construct() method.
    }

    /**
     * @return mixed
     */
    public function value()
    {
        // TODO: Implement value() method.
    }

    /**
     * @return string
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
    }

    /**
     * @return string
     */
    public function extractedValue()
    {
        // TODO: Implement extractedValue() method.
    }

}