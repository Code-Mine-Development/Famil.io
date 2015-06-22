<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 18:01
 */

namespace Famillio\Domain\Person\Collection\Preconditions;

/**
 * Interface PreconditionInterface
 *
 * Preconditions are used to determine if certain
 * conditions are meet.
 *
 * @package Famillio\Domain\Person\Collection\Preconditions
 */
interface PreconditionInterface
{
    /**
     * @return bool
     */
    public function isMeet() : bool;
}