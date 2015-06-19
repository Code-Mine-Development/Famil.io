<?php
/**
 * Date:   11/06/15
 * Time:   14:50
 *
 */

namespace Famillio\Domain\Family\Collection;

use Famillio\Domain\Family\Biography\Fact\FactInterface;
use Famillio\Domain\Family\Collection\Biography\DataExtractor\DataExtractorInterface;
use Famillio\Domain\Family\Collection\Biography\Filter\SpecificationInterface;
use Famillio\Domain\Family\Collection\Biography\MergeMode;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier;

/**
 * Interface BiographyInterface
 *
 * @package Famillio\Domain\Family\Collection
 */
interface BiographyInterface extends \Iterator, \Countable
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
     * Return new Biography collection without elements that don't comply to provided
     * specification. Method will return empty collection if no Facts were accepted by specification.
     *
     * @param \Famillio\Domain\Family\Collection\Biography\Filter\SpecificationInterface $specification
     *
     * @return \Famillio\Domain\Family\Collection\BiographyInterface
     */
    public function filtered(SpecificationInterface $specification) : BiographyInterface;

    /**
     * Return the very first fact that is stored in collection.
     *
     * @return \Famillio\Domain\Family\Biography\Fact\FactInterface
     */
    public function firstFact() : FactInterface;

    /**
     * Return latest Fact stored in collection. Returned Fact will be the Fact with latest date,
     * not the Fact that was added most recently.
     *
     * @return \Famillio\Domain\Family\Biography\Fact\FactInterface
     */
    public function lastFact() : FactInterface;

    /**
     * Extract data from Facts stored in Biography. Data Extractor object that will be used as argument
     * will be returned after satisfaction.
     *
     *
     * @param \Famillio\Domain\Family\Collection\Biography\DataExtractor\DataExtractorInterface $dataExtractorInterface
     *
     * @return \Famillio\Domain\Family\Collection\Biography\DataExtractor\DataExtractorInterface
     */
    public function extractData(DataExtractorInterface $dataExtractorInterface) : DataExtractorInterface;
}