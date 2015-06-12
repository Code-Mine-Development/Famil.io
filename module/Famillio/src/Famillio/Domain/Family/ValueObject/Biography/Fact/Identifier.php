<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 17:25
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact;


use AGmakonts\STL\AbstractValueObject;

class Identifier extends AbstractValueObject
{
    private $identifier;
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