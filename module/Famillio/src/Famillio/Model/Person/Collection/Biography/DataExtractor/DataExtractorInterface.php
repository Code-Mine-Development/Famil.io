<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 22:52
 */

namespace Famillio\Model\Person\Collection\Biography\DataExtractor;

use AGmakonts\STL\ValueObjectInterface;
use Famillio\Model\Person\Biography\Fact\FactInterface;

/**
 * Interface DataExtractorInterface
 *
 * Data Extractor Interface is used to construct extractors that are capable of
 * filtering data from Biography and processing it to return required Value.
 *
 * @package Famillio\Model\Person\Collection\Biography\DataExtractor
 */
interface DataExtractorInterface
{
    /**
     * Add Fact for extraction. Internal logic of the method will decide witch Facts
     * to use and witch ones to discard.
     *
     * @param \Famillio\Model\Person\Biography\Fact\FactInterface $factInterface
     *
     * @return void
     */
    public function registerFact(FactInterface $factInterface);

    /**
     * Return boolean value that describes if Extractor had already registered all
     * Facts that are needed to extract data.
     *
     * @return bool
     */
    public function isSatisfied() : bool;

    /**
     * @return \AGmakonts\STL\ValueObjectInterface
     */
    public function data() : ValueObjectInterface;
}