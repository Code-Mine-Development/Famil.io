<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 01:18
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact\Relation;


use AGmakonts\STL\AbstractValueObject;
use AGmakonts\STL\String\String;
use AGmakonts\STL\ValueObjectInterface;

/**
 * Interface FactRelationInterface
 *
 * @package Famillio\Domain\Famillio\ValueObject\Biography\Fact\Relation
 */
interface FactRelationInterface extends ValueObjectInterface
{
    /**
     * @return \AGmakonts\STL\String\String
     */
    public function name() : String;

    /**
     * @return \AGmakonts\STL\String\String
     */
    public function incoming() : String;

    /**
     * @return \AGmakonts\STL\String\String
     */
    public function outgoing() : String;
}