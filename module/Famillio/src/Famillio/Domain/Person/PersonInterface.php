<?php
/**
 * Date:   11/06/15
 * Time:   13:44
 * 
 */

namespace Famillio\Domain\Person;

use AGmakonts\DddBricks\Entity\EntityInterface;
use Famillio\Domain\Person\Collection\FactDataAccessInterface;

/**
 * Interface PersonInterface
 *
 * @package Famillio\Domain\Person
 */
interface PersonInterface extends EntityInterface
{
    /**
     * Returns biography collection assigned to current Person
     *
     * @return \Famillio\Domain\Person\Collection\BiographyInterface
     */
    public function biography();

    public function picture();
}