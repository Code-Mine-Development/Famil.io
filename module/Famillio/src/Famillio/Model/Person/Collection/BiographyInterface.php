<?php
/**
 * Date:   11/06/15
 * Time:   14:50
 *
 */

namespace Famillio\Model\Person\Collection;

use AGmakonts\DddBricks\Collection\CollectionInterface;
use Famillio\Model\Person\Biography\Fact\FactInterface;
use Famillio\Model\Person\Collection\Biography\DataExtractor\DataExtractorInterface;
use Famillio\Model\Person\Collection\Biography\Filter\SpecificationInterface;
use Famillio\Model\Person\Collection\Biography\MergeMode;
use Famillio\Model\Person\ValueObject\Biography\Fact\Identifier;

/**
 * Interface BiographyInterface
 *
 * @package Famillio\Model\Person\Collection
 */
interface BiographyInterface extends \Iterator, \Countable, CollectionInterface
{
    /**
     * @param \Famillio\Model\Person\Biography\Fact\FactInterface $fact
     *
     */
    public function addFact(FactInterface $fact);

    /**
     * @param \Famillio\Model\Person\ValueObject\Biography\Fact\Identifier $fact
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
     * @param \Famillio\Model\Person\Collection\BiographyInterface       $biography
     * @param \Famillio\Model\Person\Collection\Biography\MergeMode|NULL $mergeMode
     *
     * @return \Famillio\Model\Person\Collection\BiographyInterface
     */
    public function merged(BiographyInterface $biography, MergeMode $mergeMode = NULL) : BiographyInterface;

    /**
     * Return new Biography collection without elements that don't comply to provided
     * specification. Method will return empty collection if no Facts were accepted by specification.
     *
     * @param \Famillio\Model\Person\Collection\Biography\Filter\SpecificationInterface $specification
     *
     * @return \Famillio\Model\Person\Collection\BiographyInterface
     */
    public function filtered(SpecificationInterface $specification) : BiographyInterface;

    /**
     * Extract data from Facts stored in Biography. Data Extractor object that will be used as argument
     * will be returned after satisfaction.
     *
     *
     * @param \Famillio\Model\Person\Collection\Biography\DataExtractor\DataExtractorInterface $dataExtractorInterface
     *
     * @return \Famillio\Model\Person\Collection\Biography\DataExtractor\DataExtractorInterface
     */
    public function extractData(DataExtractorInterface $dataExtractorInterface) : DataExtractorInterface;
}