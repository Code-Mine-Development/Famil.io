<?php
/**
 * Date:   11/06/15
 * Time:   14:50
 * 
 */

namespace Famillio\Domain\Family\Collection;

use Famillio\Domain\Family\Biography\Fact\FactInterface;
use Famillio\Domain\Family\ValueObject\Biography\Specification;

/**
 * Interface BiographyInterface
 *
 * @package Famillio\Domain\Family\Collection
 */
interface BiographyInterface extends \Iterator, \Countable, FactDataAccessInterface
{
    /**
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface $fact
     *
     * @return mixed
     */
    public function addFact(FactInterface $fact);

    /**
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface $fact
     *
     * @return mixed
     */
    public function removeFact(FactInterface $fact);

    /**
     * @param \Famillio\Domain\Family\Collection\BiographyInterface $biography
     *
     * @return mixed
     */
    public function merged(BiographyInterface $biography) : BiographyInterface;

    /**
     * @return mixed
     */
    public function timeline() : \SplObjectStorage;

    /**
     * @param \Famillio\Domain\Family\ValueObject\Biography\Specification $specification
     *
     * @return mixed
     */
    public function filtered(Specification $specification) : BiographyInterface;

    /**
     * @return mixed
     */
    public function firstFact() : FactInterface;

    /**
     * @return mixed
     */
    public function lastFact() : FactInterface;


}