<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 01:26
 */

namespace Famillio\Model\Person\ValueObject\Biography\Fact\Relation;

use AGmakonts\STL\String\Text;

/**
 * Class CauseEffect
 *
 * @package Famillio\Model\Person\ValueObject\Biography\Fact\Relation
 */
class CauseEffect extends AbstractFactRelation
{
    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function name() : Text
    {
        return Text::get('Cause and effect');
    }

    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function incoming() : Text
    {
        return Text::get('Cause');
    }

    /**
     * @return \AGmakonts\STL\String\String
     */
    public function outgoing() : Text
    {
        return Text::get('Effect');
    }
}