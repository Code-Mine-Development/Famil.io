<?php
/**
 * Date:   11/06/15
 * Time:   13:44
 * 
 */

namespace Famillio\Domain\Family;

use AGmakonts\DddBricks\Entity\EntityInterface;

/**
 * Interface PersonInterface
 *
 * @package Famillio\Domain\Famillio
 */
interface PersonInterface extends EntityInterface
{
    public function name();

    public function changeName();

    public function biography();

    public function age();

    public function birthDate();

    public function picture();

}