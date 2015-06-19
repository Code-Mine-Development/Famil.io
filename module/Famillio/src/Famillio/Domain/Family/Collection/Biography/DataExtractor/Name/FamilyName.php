<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 13:32
 */

namespace Famillio\Domain\Family\Collection\Biography\DataExtractor\Name;


use Famillio\Domain\Family\Biography\Fact\FactInterface;
use Famillio\Domain\Family\Collection\Biography\DataExtractor\DataExtractorInterface;

/**
 * Class FamilyName
 *
 * @package Famillio\Domain\Family\Collection\Biography\DataExtractor\Name
 */
class FamilyName implements DataExtractorInterface
{
    /**
     * Add Fact for extraction. Internal logic of the method will decide witch Facts
     * to use and witch ones to discard.
     *
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface $factInterface
     *
     * @return void
     */
    public function registerFact(FactInterface $factInterface)
    {
        // TODO: Implement registerFact() method.
    }

    /**
     * Return boolean value that describes if Extractor had already registered all
     * Facts that are needed to extract data.
     *
     * @return bool
     */
    public function isSatisfied() : bool
    {
        // TODO: Implement isSatisfied() method.
    }

    /**
     * @return \AGmakonts\STL\ValueObjectInterface
     */
    public function data() : ValueObjectInterface
    {
        // TODO: Implement data() method.
    }

}