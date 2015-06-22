<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 13:32
 */

namespace Famillio\Domain\Person\Collection\Biography\DataExtractor\Name;


use AGmakonts\STL\ValueObjectInterface;
use Famillio\Domain\Person\Biography\Fact\FactInterface;
use Famillio\Domain\Person\Biography\Fact\FamilyNameChangeFactInterface;
use Famillio\Domain\Person\Collection\Biography\DataExtractor\DataExtractorInterface;
use Famillio\Domain\Person\Collection\Biography\DataExtractor\Exception\NotSatisfiedExtractorException;

/**
 * Class FamilyName
 *
 * @package Famillio\Domain\Person\Collection\Biography\DataExtractor\Name
 */
class FamilyName implements DataExtractorInterface
{
    /**
     * @var \Famillio\Domain\Person\ValueObject\Name\FamilyName
     */
    private $name;

    /**
     * Add Fact for extraction. Internal logic of the method will decide witch Facts
     * to use and witch ones to discard.
     *
     * @param \Famillio\Domain\Person\Biography\Fact\FactInterface $factInterface
     *
     * @return void
     */
    public function registerFact(FactInterface $factInterface)
    {
        if($factInterface instanceof FamilyNameChangeFactInterface) {
            $this->setName($factInterface->familyName());
        }
    }

    /**
     * @param \AGmakonts\STL\ValueObjectInterface $name
     */
    protected function setName(ValueObjectInterface $name)
    {
        $this->name = $name;
    }

    /**
     * Return boolean value that describes if Extractor had already registered all
     * Facts that are needed to extract data.
     *
     * @return bool
     */
    public function isSatisfied() : bool
    {
        return (NULL !== $this->name);
    }

    /**
     * @return \Famillio\Domain\Person\ValueObject\Name\FamilyName
     */
    public function data() : ValueObjectInterface
    {
        if(NULL === $this->name) {
            throw new NotSatisfiedExtractorException();
        }

        return $this->name;
    }

}