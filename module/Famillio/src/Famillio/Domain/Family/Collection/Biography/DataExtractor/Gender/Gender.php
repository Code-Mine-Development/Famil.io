<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 20/06/15
 * Time: 21:08
 */

namespace Famillio\Domain\Family\Collection\Biography\DataExtractor\Gender;


use AGmakonts\STL\ValueObjectInterface;
use Famillio\Domain\Family\Biography\Fact\FactInterface;
use Famillio\Domain\Family\Biography\Fact\GenderChangeFactInterface;
use Famillio\Domain\Family\Collection\Biography\DataExtractor\DataExtractorInterface;
use Famillio\Domain\Family\Collection\Biography\DataExtractor\Exception\NotSatisfiedExtractorException;

/**
 * Class Gender
 *
 * @package Famillio\Domain\Family\Collection\Biography\DataExtractor\Gender
 */
class Gender implements DataExtractorInterface
{
    /**
     * @var \Famillio\Domain\Family\ValueObject\Gender
     */
    private $gender;

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
        if($factInterface instanceof GenderChangeFactInterface) {
            $this->gender = $factInterface->gender();
        }
    }

    /**
     * Return boolean value that describes if Extractor had already registered all
     * Facts that are needed to extract data.
     *
     * @return bool
     */
    public function isSatisfied() : bool
    {
        return (NULL !== $this->gender);
    }

    /**
     * @return \AGmakonts\STL\ValueObjectInterface
     */
    public function data() : ValueObjectInterface
    {
        if(FALSE === $this->isSatisfied()) {
            throw new NotSatisfiedExtractorException();
        }

        return $this->gender;
    }

}