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
 * @package Famillio\Domain\Famillio
 */
interface PersonInterface extends EntityInterface
{
    /**
     * @return \Famillio\Domain\Family\Collection\BiographyInterface
     */
    public function biography();

    public function picture();

    public function relations();
}