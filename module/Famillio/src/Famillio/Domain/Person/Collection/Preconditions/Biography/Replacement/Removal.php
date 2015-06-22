<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 18:03
 */

namespace Famillio\Domain\Person\Collection\Preconditions\Biography\Replacement;


/**
 * Class Removal
 *
 * @package Famillio\Domain\Person\Collection\Preconditions\Biography\Replacement
 */
class Removal extends AbstractReplacementPrecondition
{

    /**
     * @return bool
     */
    public function isMeet() : bool
    {
        $areBaseConditionsMeet = $this->areBaseConditionsMeet();
        $isNewFactNull         = (NULL === $this->newFact());

        return ($areBaseConditionsMeet && $isNewFactNull);
    }

    /**
     * @return bool
     */
    protected function areBaseConditionsMeet() : bool
    {
        $oldFactNotNull    = (NULL !== $this->oldFact());
        $identifierNotNull = (NULL !== $this->identifier());

        $datesMatch       = ($this->oldFact()->date() === $this->identifier()->date());
        $identifiersMatch = ($this->oldFact()->identity() === $this->identifier());

        return ($oldFactNotNull && $identifierNotNull && $datesMatch && $identifiersMatch);
    }

}