<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 18:18
 */

namespace Famillio\Domain\Family\Collection\Preconditions\Biography\Replacement;

/**
 * Class Replacement
 *
 * @package Famillio\Domain\Family\Collection\Preconditions\Biography\Replacement
 */
class Replacement extends Remove
{
    /**
     * @return bool
     */
    public function isMeet() : bool
    {
        $removalPreconditionMeet = $this->areBaseConditionsMeet();

        $newFactNotNull = (NULL !== $this->newFact());
        $datesMatch = ($this->newFact()->date() === $this->oldFact()->date());
        $typesMatch = ($this->newFact()->type() === $this->oldFact()->type());

        return ($removalPreconditionMeet && $newFactNotNull && $datesMatch && $typesMatch);
    }
}