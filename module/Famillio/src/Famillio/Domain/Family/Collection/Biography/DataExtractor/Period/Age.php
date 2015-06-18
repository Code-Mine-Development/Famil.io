<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 22:54
 */

namespace Famillio\Domain\Family\Collection\Biography\DataExtractor\Period;

use AGmakonts\DddBricks\ValueObject\ValueObjectInterface;
use Famillio\Domain\Family\Biography\Fact\FactInterface;
use Famillio\Domain\Family\Biography\Fact\LifespanBoundaryFactInterface;
use Famillio\Domain\Family\Collection\Biography\DataExtractor\DataExtractorInterface;
use Famillio\Domain\Family\ValueObject\Biography\Fact\LifespanBoundaryType;

/**
 * Class Age
 *
 * @package Famillio\Domain\Family\Collection\Biography\DataExtractor\Period
 */
class Age implements DataExtractorInterface
{

    private $lifespanStart;

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
        if(NULL !== $this->lifespanStart) {

        }

        $this->lifespanStart = $boundaryFactInterface;
    }

    private function setEnd(LifespanBoundaryFactInterface $boundaryFactInterface)
    {
        if(NULL !== $this->lifespanEnd) {

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

    }

}