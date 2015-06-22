<?php
/**
 * Date:   11/06/15
 * Time:   14:50
 *
 */

namespace Famillio\Domain\Person\Collection;

use AGmakonts\DddBricks\Collection\CollectionInterface;
use Famillio\Domain\Person\Biography\Fact\FactInterface;
use Famillio\Domain\Person\Collection\Biography\DataExtractor\DataExtractorInterface;
use Famillio\Domain\Person\Collection\Biography\Filter\SpecificationInterface;
use Famillio\Domain\Person\Collection\Biography\MergeMode;
use Famillio\Domain\Person\ValueObject\Biography\Fact\Identifier;

/**
 * Interface BiographyInterface
 *
 * @package Famillio\Domain\Person\Collection
 */
interface BiographyInterface extends \Iterator, \Countable, CollectionInterface
{
    /**
     * @param \Famillio\Domain\Person\Biography\Fact\FactInterface $fact
     *
     */
    public function addFact(FactInterface $fact);

    /**
     * @param \Famillio\Domain\Person\ValueObject\Biography\Fact\Identifier $fact
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
     * @param \Famillio\Domain\Person\Collection\BiographyInterface       $biography
     * @param \Famillio\Domain\Person\Collection\Biography\MergeMode|NULL $mergeMode
     *
     * @return \Famillio\Domain\Person\Collection\BiographyInterface
     */
    public function merged(BiographyInterface $biography, MergeMode $mergeMode = NULL) : BiographyInterface;

    /**
     * Return new Biography collection without elements that don't comply to provided
     * specification. Method will return empty collection if no Facts were accepted by specification.
     *
     * @param \Famillio\Domain\Person\Collection\Biography\Filter\SpecificationInterface $specification
     *
     * @return \Famillio\Domain\Person\Collection\BiographyInterface
     */
    public function filtered(SpecificationInterface $specification) : BiographyInterface;

    /**
     * Extract data from Facts stored in Biography. Data Extractor object that will be used as argument
     * will be returned after satisfaction.
     *
     *
     * @param \Famillio\Domain\Person\Collection\Biography\DataExtractor\DataExtractorInterface $dataExtractorInterface
     *
     * @return \Famillio\Domain\Person\Collection\Biography\DataExtractor\DataExtractorInterface
     */
    public function extractData(DataExtractorInterface $dataExtractorInterface) : DataExtractorInterface;
}