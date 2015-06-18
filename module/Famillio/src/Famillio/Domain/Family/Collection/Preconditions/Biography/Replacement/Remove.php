<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 18:03
 */

namespace Famillio\Domain\Family\Collection\Preconditions\Biography\Replacement;



/**
 * Class Remove
 *
 * @package Famillio\Domain\Family\Collection\Preconditions\Biography\Replacement
 */
class Remove extends AbstractReplacementPrecondition
{

    /**
     * @return bool
     */
    public function isMeet() : bool
    {
        $oldFactNotNull = (NULL !== $this->oldFact());
        $identifierNotNull = (NULL !== $this->identifier());

        $datesMatch = ($this->oldFact()->date() === $this->identifier()->date());
        $identifiersMatch = ($this->oldFact()->identity() === $this->identifier());


        return ($oldFactNotNull && $identifierNotNull && $datesMatch && $identifiersMatch);
    }

}