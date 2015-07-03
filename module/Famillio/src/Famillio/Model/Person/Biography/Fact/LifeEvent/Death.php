<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 12:26
 */

namespace Famillio\Model\Person\Biography\Fact\LifeEvent;


use AGmakonts\STL\String\Text;
use Famillio\Model\Person\Biography\Fact\AbstractFact;
use Famillio\Model\Person\Biography\Fact\LifespanBoundaryFactInterface;
use Famillio\Model\Person\ValueObject\Biography\Fact\LifespanBoundaryType;

/**
 * Class Death
 *
 * @package Famillio\Model\Person\Biography\Fact\LifeEvent
 */
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