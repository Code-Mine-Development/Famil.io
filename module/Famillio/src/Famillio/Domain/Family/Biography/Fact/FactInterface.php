<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 10:42
 */

namespace Famillio\Domain\Family\Biography\Fact;


use AGmakonts\STL\DateTime\DateTime;
use AGmakonts\DddBricks\Entity\EntityInterface;
use AGmakonts\STL\String\Text;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Description;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Story;

/**
 * Interface FactInterface
 *
 * Fact is a representation of single event in person's biography.
 * Each fact has immutable date and identifier. Apart from that, each
 * Fact can be extended by interfaces that add new data to it.
 *
 * @package Famillio\Domain\Family\Biography\Fact
 */
interface FactInterface extends EntityInterface
{
    /**
     * @return DateTime
     */
    public function date() : DateTime;

    /**
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Description
     */
    public function description() : Description;

    /**
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Description $description
     */
    public function changeDescription(Description $description);


    public function timeSinceFact();

    /**
     * Return DateTime object with the date of next anniversary of the Fact.
     *
     * @return \AGmakonts\STL\DateTime\DateTime
     */
    public function nextAnniversary() : DateTime;

    /**
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Story $customStory
     *
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
    public function story(Story $customStory = NULL) : Story;

    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function type() : Text;

    /**
     * @param \AGmakonts\STL\DateTime\DateTime $dateTime
     *
     * @return \Famillio\Domain\Family\Biography\Fact\FactInterface
     */
    public function changedDate(DateTime $dateTime) : FactInterface;
}