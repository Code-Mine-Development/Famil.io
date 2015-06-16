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
     * @return \AGmakonts\STL\DateTime\DateTime
     */
    public function nextAnniversary() : DateTime;

    /**
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
    public function story() : Story;

    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function type() : Text;
}