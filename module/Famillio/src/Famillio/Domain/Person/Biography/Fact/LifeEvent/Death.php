<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 12:26
 */

namespace Famillio\Domain\Person\Biography\Fact\LifeEvent;


use AGmakonts\STL\String\Text;
use Famillio\Domain\Person\Biography\Fact\AbstractFact;
use Famillio\Domain\Person\Biography\Fact\LifespanBoundaryFactInterface;
use Famillio\Domain\Person\ValueObject\Biography\Fact\LifespanBoundaryType;

class Death extends AbstractFact implements LifespanBoundaryFactInterface
{
    /**
     * @return mixed
     */
    public function type() : Text
    {
        return Text::get('Death');
    }

    /**
     * @return mixed
     */
    public function lifespanBoundaryType() : LifespanBoundaryType
    {
        // TODO: Implement lifespanBoundaryType() method.
    }

}