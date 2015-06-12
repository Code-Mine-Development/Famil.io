<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 01:26
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact\Relation;

use AGmakonts\STL\String\String;

/**
 * Class CauseEffect
 *
 * @package Famillio\Domain\Famillio\ValueObject\Biography\Fact\Relation
 */
class CauseEffect extends AbstractFactRelation
{
    /**
     * @return \AGmakonts\STL\String\String
     */
    public function name() : String
    {
        return String::get('Cause and effect');
    }

    /**
     * @return \AGmakonts\STL\String\String
     */
    public function incoming() : String
    {
        return String::get('Cause');
    }

    /**
     * @return \AGmakonts\STL\String\String
     */
    public function outgoing() : String
    {
        return String::get('Effect');
    }
}