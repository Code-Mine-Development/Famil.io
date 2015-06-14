<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 01:18
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact\Relation;


use AGmakonts\STL\AbstractValueObject;
use AGmakonts\STL\String\Text;
use AGmakonts\STL\ValueObjectInterface;

/**
 * Interface FactRelationInterface
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact\Relation
 */
interface FactRelationInterface extends ValueObjectInterface
{
    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function name() : Text;

    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function incoming() : Text;

    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function outgoing() : Text;
}