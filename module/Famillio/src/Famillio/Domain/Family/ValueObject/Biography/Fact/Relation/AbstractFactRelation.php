<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 01:34
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact\Relation;


use AGmakonts\Stl\ValueObjectInterface;

/**
 * Class AbstractFactRelation
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact\Relation
 */
abstract class AbstractFactRelation implements ValueObjectInterface, FactRelationInterface
{

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->name()->value();
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
        return get_called_class();
    }
}