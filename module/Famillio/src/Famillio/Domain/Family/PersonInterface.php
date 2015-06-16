<?php
/**
 * Date:   11/06/15
 * Time:   13:44
 * 
 */

namespace Famillio\Domain\Family;

use AGmakonts\DddBricks\Entity\EntityInterface;
use Famillio\Domain\Family\Collection\FactDataAccessInterface;

/**
 * Interface PersonInterface
 *
 * @package Famillio\Domain\Family
 */
interface PersonInterface extends EntityInterface, FactDataAccessInterface
{
    public function name();

    public function changeName();

    public function biography();

    public function age();

    public function birthDate();

    public function picture();

}