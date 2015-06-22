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
use Famillio\Domain\Family\ValueObject\Biography\Fact\Status;
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
     * Return date of the Fact instance creation
     *
     * @return \AGmakonts\STL\DateTime\DateTime
     */
    public function creationTime() : DateTime;

    /**
     * Return date of the last Fact update
     *
     * @return \AGmakonts\STL\DateTime\DateTime
     */
    public function lastUpdateTime() : DateTime;

    /**
     * Returns date of the fact occurrence. Returned property is
     * immutable.
     *
     * @return DateTime
     */
    public function date() : DateTime;

    /**
     * Returns meaningful description of a Fact.
     *
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Description
     */
    public function description() : Description;

    /**
     * Changes description of a Fact to new one.
     *
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Description $description
     */
    public function changeDescription(Description $description);


    /**
     * Returns interval between Fact's occurrence and specific date.
     * By default interval is calculated to current date. Optional parameter
     * allows to specify different date.
     *
     * @param \AGmakonts\STL\DateTime\DateTime $toDate
     *
     * @return mixed
     */
    public function timeSinceFact(DateTime $toDate = NULL);

    /**
     * Return DateTime object with the date of next anniversary of the Fact.
     *
     * @return \AGmakonts\STL\DateTime\DateTime
     */
    public function nextAnniversary() : DateTime;

    /**
     * Returns prepared Story object that can be used to describe in
     * narrative way Fact's data.
     *
     * Method allows to specify optional Story object that will be filled
     * with data instead of default Story.
     *
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Story $customStory
     *
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
    public function story(Story $customStory = NULL) : Story;

    /**
     * Returns textual representation of Fact's type.
     *
     * @return \AGmakonts\STL\String\Text
     */
    public function type() : Text;

    /**
     * Due to immutable nature of the Facts, change of the date requires
     * building new instance.
     *
     * @param \AGmakonts\STL\DateTime\DateTime $dateTime
     *
     * @return \Famillio\Domain\Family\Biography\Fact\FactInterface
     */
    public function changedDate(DateTime $dateTime) : FactInterface;

    /**
     * Returns current status of the Fact
     *
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Status
     */
    public function status() : Status;
}