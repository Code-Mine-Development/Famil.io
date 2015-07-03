<?php
/**
 * Date:   11/06/15
 * Time:   13:44
 * 
 */

namespace Famillio\Model\Person;

use AGmakonts\DddBricks\Entity\EntityInterface;
use Famillio\Model\Person\Collection\FactDataAccessInterface;
use Famillio\Model\Person\ValueObject\Picture;

/**
 * Interface PersonInterface
 *
 * Entities that are realizations of Person Interface are representation
 * of real person. Each Person has it's own biography that determines his
 * properties such as name, age and relationships.
 *
 * @package Famillio\Model\Person
 */
interface PersonInterface extends EntityInterface
{
    /**
     * Returns biography collection assigned to current Person
     *
     * @return \Famillio\Model\Person\Collection\BiographyInterface
     */
    public function biography();

    /**
     * Return picture that is used to present person
     *
     * @return \Famillio\Model\Person\ValueObject\Picture
     */
    public function picture() : Picture;

    /**
     * @param \Famillio\Model\Person\ValueObject\Picture $picture
     *
     * @return void
     */
    public function changePicture(Picture $picture);

    /**
     * @return \SplObjectStorage
     */
    public function socialLinks() : \SplObjectStorage;
}