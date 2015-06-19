<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 22:54
 */

namespace Famillio\Domain\Family\Collection\Biography\DataExtractor\Period;

use AGmakonts\STL\Number\Integer;
use AGmakonts\Stl\ValueObjectInterface;
use Famillio\Domain\Family\Biography\Fact\FactInterface;
use Famillio\Domain\Family\Biography\Fact\LifespanBoundaryFactInterface;
use Famillio\Domain\Family\Collection\Biography\DataExtractor\DataExtractorInterface;
use Famillio\Domain\Family\Collection\Biography\DataExtractor\Exception\NotSatisfiedExtractorException;
use Famillio\Domain\Family\Collection\Biography\DataExtractor\Exception\OversatisfiedExtractorException;
use Famillio\Domain\Family\ValueObject\Biography\Fact\LifespanBoundaryType;

/**
 * Class Age
 *
 * Extracts age of person described by Biography. Returned value is an
 * Integer.
 *
 * @package Famillio\Domain\Family\Collection\Biography\DataExtractor\Period
 */
class Age implements DataExtractorInterface
{
    /**
     * @var \Famillio\Domain\Family\Biography\Fact\FactInterface
     */
    private $lifespanStart;

    /**
     * @var \Famillio\Domain\Family\Biography\Fact\FactInterface
     */
    private $lifespanEnd;

    /**
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface $factInterface
     *
     * @return void
     */
    public function registerFact(FactInterface $factInterface)
    {
        if (TRUE === ($factInterface instanceof LifespanBoundaryFactInterface)) {

            /** @var \Famillio\Domain\Family\Biography\Fact\LifespanBoundaryFactInterface $factInterface */
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
     * @param \Famillio\Domain\Family\Biography\Fact\LifespanBoundaryFactInterface $boundaryFactInterface
     */
    private function setStart(LifespanBoundaryFactInterface $boundaryFactInterface)
    {
        if (NULL !== $this->lifespanStart) {
            throw new OversatisfiedExtractorException('Lifespan start date already set.');
        }

        $this->lifespanStart = $boundaryFactInterface;
    }

    /**
     * @param \Famillio\Domain\Family\Biography\Fact\LifespanBoundaryFactInterface $boundaryFactInterface
     */
    private function setEnd(LifespanBoundaryFactInterface $boundaryFactInterface)
    {
        if (NULL !== $this->lifespanEnd) {
            throw new OversatisfiedExtractorException('Lifespan end date already set.');
        }

        $this->lifespanEnd = $boundaryFactInterface;
    }

    /**
     * @return bool
     */
    public function isSatisfied() : bool
    {
        return (NULL !== $this->lifespanEnd && NULL !== $this->lifespanStart);
    }

    /**
     * @return \AGmakonts\STL\ValueObjectInterface
     */
    public function data() : ValueObjectInterface
    {
        if(FALSE === $this->isSatisfied()) {
            throw new NotSatisfiedExtractorException();
        }

        $nativeDateTimeOfStart = new \DateTime($this->lifespanStart->date()->getTimestamp()->value());
        $nativeDateTimeOfEnd   = new \DateTime($this->lifespanEnd->date()->getTimestamp()->value());

        $difference = $nativeDateTimeOfStart->diff($nativeDateTimeOfEnd);

        $age = $difference->y;

        return Integer::get($age);

    }

}