<?php
/**
 * Date:   11/06/15
 * Time:   14:52
 * 
 */

namespace Famillio\Domain\Family\Biography\Fact;

use AGmakonts\DddBricks\Entity\EntityInterface;
use AGmakonts\STL\DateTime\DateTime;
use AGmakonts\STL\Number\Integer;
use Famillio\Domain\Family\Biography\Fact\Exception\DateAlreadySetException;
use Famillio\Domain\Family\Biography\Fact\Exception\DateNotSetYetException;
use Famillio\Domain\Family\Biography\Fact\Exception\FactIdentifierAlreadySetException;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Description;
use Famillio\Domain\Family\Biography\Fact\Exception\DateInFutureException;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier;

/**
 * Class AbstractFact
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact
 */
abstract class AbstractFact implements FactInterface
{
    /**
     * @var \AGmakonts\STL\DateTime\DateTime
     */
    private $date;

    /**
     * @var \Famillio\Domain\Family\ValueObject\Biography\Fact\Description
     */
    private $description;

    private $location;

    /**
     * @var \Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier
     */
    private $identity;

    private $relatedFacts;

    /**
     * @return mixed
     */
    public function location()
    {
        return $this->location;
    }

    /**
     * @param $location
     */
    protected function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @param $location
     */
    public function changeLocation($location)
    {
        $this->setLocation($location);
    }

    /**
     * @param \AGmakonts\STL\DateTime\DateTime $date
     */
    final protected function setDate(DateTime $date)
    {
        if(TRUE === $date->isFurtherThan(DateTime::get()) &&
           FALSE === $date->isToday()) {
            throw new DateInFutureException($date);
        }

        if(NULL === $this->date) {
            throw new DateAlreadySetException($this, $date);
        }

        $this->date = $date;
    }

    /**
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Description $description
     */
    protected function setDescription(Description $description)
    {
        $this->description = $description;
    }

    /**
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier $identifier
     */
    protected function setIdentity(Identifier $identifier)
    {
        if(NULL !== $this->identity) {
            throw new FactIdentifierAlreadySetException($this);
        }

        $this->identity = $identifier;
    }

    /**
     * @return DateTime
     */
    public function date() : DateTime
    {
        if(NULL === $this->date) {
            throw new DateNotSetYetException($this);
        }

        return $this->date;
    }

    /**
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Description
     */
    public function description() : Description
    {
        return $this->description;
    }

    /**
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Description $description
     */
    public function changeDescription(Description $description)
    {
        $this->setDescription($description);
    }

    /**
     * @param \AGmakonts\DddBricks\Entity\EntityInterface $entity
     *
     * @return bool
     */
    public function assertIsTheSameAs(EntityInterface $entity)
    {
        return (get_class($entity) === get_class() && $entity->identity() === $this->identity());
    }

    /**
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier
     */
    public function identity() : Identifier
    {
        return $this->identity;
    }

    public function timeSinceFact()
    {

    }

    /**
     * @return \AGmakonts\STL\DateTime\DateTime
     */
    public function nextAnniversary() : DateTime
    {
        $nativeDate = new \DateTime($this->date()->getTimestamp()->value());
        $now = new \DateTime();

        $interval = new \DateInterval('P1Y');

        while($nativeDate->getTimestamp() < $now->getTimestamp()) {
            $nativeDate = $nativeDate->add($interval);
        }

        return DateTime::get(Integer::get($nativeDate->getTimestamp()));
    }





}