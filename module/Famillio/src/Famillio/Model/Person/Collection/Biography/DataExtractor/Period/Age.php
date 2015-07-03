<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 22:54
 */

namespace Famillio\Model\Person\Collection\Biography\DataExtractor\Period;

use AGmakonts\STL\Number\Integer;
use AGmakonts\Stl\ValueObjectInterface;
use Famillio\Model\Person\Biography\Fact\FactInterface;
use Famillio\Model\Person\Biography\Fact\LifespanBoundaryFactInterface;
use Famillio\Model\Person\Collection\Biography\DataExtractor\DataExtractorInterface;
use Famillio\Model\Person\Collection\Biography\DataExtractor\Exception\NotSatisfiedExtractorException;
use Famillio\Model\Person\Collection\Biography\DataExtractor\Exception\OversatisfiedExtractorException;
use Famillio\Model\Person\ValueObject\Biography\Fact\LifespanBoundaryType;

/**
 * Class Age
 *
 * Extracts age of person described by Biography. Returned value is an
 * Integer. To extract correct data, Extractor needs to register two Facts
 * that are implementing LifespanBoundaryFactInterface.
 *
 * If it will register more than two of those or less that two exception
 * will be thrown.
 *
 * @package Famillio\Model\Person\Collection\Biography\DataExtractor\Period
 */
class Age implements DataExtractorInterface
{
    /**
     * Fact that represents birth
     *
     * @var \Famillio\Model\Person\Biography\Fact\FactInterface
     */
    private $lifespanStart;

    /**
     * Fact that represents death
     *
     * @var \Famillio\Model\Person\Biography\Fact\FactInterface
     */
    private $lifespanEnd;

    /**
     * Add Fact for extraction. Internal logic of the method will decide witch Facts
     * to use and witch ones to discard.
     *
     * @param \Famillio\Model\Person\Biography\Fact\FactInterface $factInterface
     *
     * @return void
     */
    public function registerFact(FactInterface $factInterface)
    {
        /*
         * Only Lifespan Boundary Facts are interesting
         * Discard all the rest
         */
        if (TRUE === ($factInterface instanceof LifespanBoundaryFactInterface)) {

            /** @var \Famillio\Model\Person\Biography\Fact\LifespanBoundaryFactInterface $factInterface */
            switch ($factInterface->lifespanBoundaryType()) {

                case LifespanBoundaryType::get(LifespanBoundaryType::BEGINNING) :
                    $this->setStart($factInterface);
                    break;

                case LifespanBoundaryType::get(LifespanBoundaryType::END) :
                    $this->setEnd($factInterface);
                    break;

                default:
                    break;
            }
        }
    }

    /**
     * @param \Famillio\Model\Person\Biography\Fact\LifespanBoundaryFactInterface $boundaryFactInterface
     *
     * @throws OversatisfiedExtractorException
     */
    private function setStart(LifespanBoundaryFactInterface $boundaryFactInterface)
    {
        /*
         * If Biography contained more than one Fact that describes birth
         * we have a problem and exception is needed
         */
        if (NULL !== $this->lifespanStart) {
            throw new OversatisfiedExtractorException('Lifespan start date already set.');
        }

        $this->lifespanStart = $boundaryFactInterface;
    }

    /**
     * @param \Famillio\Model\Person\Biography\Fact\LifespanBoundaryFactInterface $boundaryFactInterface
     *
     * @throws OversatisfiedExtractorException
     */
    private function setEnd(LifespanBoundaryFactInterface $boundaryFactInterface)
    {
        /*
         * If Biography contained more than one Fact that describes death
         * we have a problem and exception is needed
         */
        if (NULL !== $this->lifespanEnd) {
            throw new OversatisfiedExtractorException('Lifespan end date already set.');
        }

        $this->lifespanEnd = $boundaryFactInterface;
    }

    /**
     * Return boolean value that describes if Extractor had already registered all
     * Facts that are needed to extract data.
     *
     * Age extractor is satisfied when both, birth and death Facts are registered.
     *
     * @return bool
     */
    public function isSatisfied() : bool
    {
        return (NULL !== $this->lifespanEnd && NULL !== $this->lifespanStart);
    }


    /**
     * @return \AGmakonts\STL\ValueObjectInterface
     *
     * @throws NotSatisfiedExtractorException
     */
    public function data() : ValueObjectInterface
    {
        /*
         * This extractor needs to be satisfied in order to extract data.
         * If it's not, throw an exception
         */
        if (FALSE === $this->isSatisfied()) {
            throw new NotSatisfiedExtractorException();
        }

        /*
         * Convert dates to native objects because STL doesnt't
         * support date calculations at this time
         */
        $nativeDateTimeOfStart = new \DateTime($this->lifespanStart->date()->getTimestamp()->value());
        $nativeDateTimeOfEnd   = new \DateTime($this->lifespanEnd->date()->getTimestamp()->value());

        $difference = $nativeDateTimeOfStart->diff($nativeDateTimeOfEnd);
        $age        = $difference->y;

        return Integer::get($age);
    }
}