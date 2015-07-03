<?php
/**
 * Date:   11/06/15
 * Time:   13:44
 * 
 */

namespace Famillio\Model\Person;
use AGmakonts\DddBricks\Entity\EntityInterface;
use Famillio\Model\Person\ValueObject\Picture;

/**
 * Class Person
 *
 * @package Famillio\Model\Person
 */
class Person implements PersonInterface
{
    public function assertIsTheSameAs(EntityInterface $entity)
    {
        // TODO: Implement assertIsTheSameAs() method.
    }

    public function identity()
    {
        // TODO: Implement identity() method.
    }

    /**
     * Returns biography collection assigned to current Person
     *
     * @return \Famillio\Model\Person\Collection\BiographyInterface
     */
    public function biography()
    {
        // TODO: Implement biography() method.
    }

    /**
     * Return picture that is used to present person
     *
     * @return \Famillio\Model\Person\ValueObject\Picture
     */
    public function picture() : Picture
    {
        // TODO: Implement picture() method.
    }

    /**
     * @param \Famillio\Model\Person\ValueObject\Picture $picture
     *
     * @return void
     */
    public function changePicture(Picture $picture)
    {
        // TODO: Implement changePicture() method.
    }

    /**
     * @return \SplObjectStorage
     */
    public function socialLinks() : \SplObjectStorage
    {
        // TODO: Implement socialLinks() method.
    }

}