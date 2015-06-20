<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 13:32
 */

namespace Famillio\Domain\Family\Collection\Biography\DataExtractor\Name;

use AGmakonts\STL\String\Text;
use AGmakonts\STL\ValueObjectInterface;
use Famillio\Domain\Family\Biography\Fact\FactInterface;
use Famillio\Domain\Family\Collection\Biography\DataExtractor\DataExtractorInterface;
use Famillio\Domain\Family\Collection\Biography\DataExtractor\Exception\NotSatisfiedExtractorException;

/**
 * Class FullName
 *
 * @package Famillio\Domain\Family\Collection\Biography\DataExtractor\Name
 */
class FullName implements DataExtractorInterface
{
    /**
     * @var \Famillio\Domain\Family\Collection\Biography\DataExtractor\Name\FamilyName
     */
    private $familyNameExtractor;

    /**
     * @var \Famillio\Domain\Family\Collection\Biography\DataExtractor\Name\GivenName
     */
    private $givenNameExtractor;

    /**
     * FullName constructor.
     */
    public function __construct()
    {
        $this->familyNameExtractor = new FamilyName();
        $this->givenNameExtractor  = new GivenName();
    }

    /**
     * @return DataExtractorInterface
     */
    private function familyNameExtractor()
    {
        return $this->familyNameExtractor;
    }

    /**
     * @return DataExtractorInterface
     */
    private function givenNameExtractor()
    {
        return $this->givenNameExtractor;
    }


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
        $this->givenNameExtractor()->registerFact($factInterface);
        $this->familyNameExtractor()->registerFact($factInterface);
    }

    /**
     * Return boolean value that describes if Extractor had already registered all
     * Facts that are needed to extract data.
     *
     * @return bool
     */
    public function isSatisfied() : bool
    {
        return (TRUE === $this->familyNameExtractor()->isSatisfied() &&
            TRUE === $this->givenNameExtractor()->isSatisfied());
    }

    /**
     * @return \AGmakonts\STL\ValueObjectInterface
     */
    public function data() : ValueObjectInterface
    {
        if (FALSE === $this->isSatisfied()) {
            throw new NotSatisfiedExtractorException();
        }

        /** @var \Famillio\Domain\Family\ValueObject\Name\FamilyName $familyName */
        $familyName = $this->familyNameExtractor()->data();
        /** @var \Famillio\Domain\Family\ValueObject\Name\GivenName $givenName */
        $givenName = $this->givenNameExtractor()->data();

        return $givenName->name()->concat($familyName, Text::get(' '));


    }

}