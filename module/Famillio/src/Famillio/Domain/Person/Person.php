<?php
/**
 * Date:   11/06/15
 * Time:   13:44
 * 
 */

namespace Famillio\Domain\Person;
use AGmakonts\DddBricks\Entity\EntityInterface;
use Famillio\Domain\Person\ValueObject\Picture;

/**
 * Class Person
 *
 * @package Famillio\Domain\Person
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
     * @return \Famillio\Domain\Person\Collection\BiographyInterface
     */
    public function biography()
    {
        // TODO: Implement biography() method.
    }

    /**
     * Return picture that is used to present person
     *
     * @return \Famillio\Domain\Person\ValueObject\Picture
     */
    public function picture() : Picture
    {
        // TODO: Implement picture() method.
    }

    /**
     * @param \Famillio\Domain\Person\ValueObject\Picture $picture
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