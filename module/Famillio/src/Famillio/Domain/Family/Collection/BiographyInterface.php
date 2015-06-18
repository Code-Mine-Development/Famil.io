<?php
/**
 * Date:   11/06/15
 * Time:   14:50
 *
 */

namespace Famillio\Domain\Family\Collection;

use Famillio\Domain\Family\Biography\Fact\FactInterface;
use Famillio\Domain\Family\Collection\Biography\MergeMode;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier;
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
     */
    public function addFact(FactInterface $fact);

    /**
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier $fact
     *
     * @return void
     */
    public function removeFact(Identifier $fact);

    /**
     * Returns new Biography object that contains Facts from both (current and
     * passed as an argument) Biographies.
     *
     * Two processed biographies can have duplicated Facts. When duplicate is found
     * $mergeMode argument will be used to determine way of handling it.
     *
     *
     * @param \Famillio\Domain\Family\Collection\BiographyInterface       $biography
     * @param \Famillio\Domain\Family\Collection\Biography\MergeMode|NULL $mergeMode
     *
     * @return \Famillio\Domain\Family\Collection\BiographyInterface
     */
    public function merged(BiographyInterface $biography, MergeMode $mergeMode = NULL) : BiographyInterface;

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