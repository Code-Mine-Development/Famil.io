<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 12:26
 */

namespace Famillio\Domain\Family\Biography\Fact\LifeEvent;


use AGmakonts\STL\String\String;
use Famillio\Domain\Family\Biography\Fact\AbstractFact;
use Famillio\Domain\Family\Biography\Fact\LifespanBoundaryFactInterface;

class Death extends AbstractFact implements LifespanBoundaryFactInterface
{
    /**
     * @return mixed
     */
    public function type() : String
    {
        return String::get('Death');
    }

    /**
     * @return mixed
     */
    public function lifespanBoundaryType() : LifespanBoundaryType
    {
        // TODO: Implement lifespanBoundaryType() method.
    }

}