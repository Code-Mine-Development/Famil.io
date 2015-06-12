<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 10:42
 */

namespace Famillio\Domain\Family\Biography\Fact;


use AGmakonts\STL\DateTime\DateTime;
use AGmakonts\STL\String\String;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Description;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Story;

/**
 * Interface FactInterface
 *
 * @package Famillio\Domain\Family\Biography\Fact
 */
interface FactInterface
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
     * @param \AGmakonts\STL\DateTime\DateTime $date
     */
    public function changeDate(DateTime $date);

    /**
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Description $description
     */
    public function changeDescription(Description $description);


    public function timeSinceFact();

    /**
     * @return \AGmakonts\STL\DateTime\DateTime
     */
    public function nextAnniversary() : DateTime;

    /**
     * @return mixed
     */
    public function story() : Story;
}