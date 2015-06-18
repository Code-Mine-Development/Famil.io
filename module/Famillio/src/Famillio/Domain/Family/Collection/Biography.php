<?php
/**
 * Date:   11/06/15
 * Time:   14:50
 *
 */

namespace Famillio\Domain\Family\Collection;

use AGmakonts\STL\Number\Integer;
use Famillio\Domain\Family\Biography\Fact\FactInterface;
use Famillio\Domain\Family\Collection\Exception\DuplicatedFactAdditionAttemptException;
use Famillio\Domain\Family\ValueObject\Biography\Specification;
use Famillio\Domain\Family\ValueObject\Gender;
use Famillio\Domain\Family\ValueObject\Name\FamilyName;
use Famillio\Domain\Family\ValueObject\Name\GivenName;

/**
 * Class Biography
 *
 * @package Famillio\Domain\Family\Collection
 */
class Biography implements BiographyInterface
{
    private $factsTimeline;

    private $factIdentifiers;

    /**
     * Biography constructor.
     */
    public function __construct()
    {
        $this->factsTimeline   = new \SplDoublyLinkedList();
        $this->factIdentifiers = new \SplObjectStorage();
    }

    /**
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface $fact
     *
     */
    public function addFact(FactInterface $fact)
    {
        if (TRUE === $this->factIdentifiers()->contains($fact->identity())) {
            throw new DuplicatedFactAdditionAttemptException($fact);
        }

        
        $scalarDateIndex = $fact->date()->getTimestamp()->value();

        if (FALSE === $this->facts()->offsetExists($scalarDateIndex)) {
            $dateContainer = new \SplObjectStorage();
            $this->facts()->add($scalarDateIndex, $dateContainer);
        } else {
            $dateContainer = $this->facts()->offsetGet($scalarDateIndex);
        }


        $dateContainer->attach($fact->identity(), $fact);
        $this->factIdentifiers()->attach($fact->identity());
    }

    /**
     * @return \SplObjectStorage
     */
    private function factIdentifiers() : \SplObjectStorage
    {
        return $this->factIdentifiers;
    }

    /**
     * @return \SplDoublyLinkedList
     */
    private function facts() : \SplDoublyLinkedList
    {
        return $this->factsTimeline;
    }

    /**
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface $fact
     *
     */
    public function removeFact(FactInterface $fact)
    {

    }

    /**
     * @param \Famillio\Domain\Family\Collection\BiographyInterface $biography
     *
     * @return mixed
     */
    public function merged(BiographyInterface $biography) : BiographyInterface
    {
        // TODO: Implement merged() method.
    }

    /**
     * @return mixed
     */
    public function timeline() : \SplObjectStorage
    {
        // TODO: Implement timeline() method.
    }

    /**
     * @param \Famillio\Domain\Family\ValueObject\Biography\Specification $specification
     *
     * @return mixed
     */
    public function filtered(Specification $specification) : BiographyInterface
    {
        // TODO: Implement filtered() method.
    }

    /**
     * @return mixed
     */
    public function firstFact() : FactInterface
    {
        // TODO: Implement firstFact() method.
    }

    /**
     * @return mixed
     */
    public function lastFact() : FactInterface
    {
        // TODO: Implement lastFact() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     *
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        // TODO: Implement current() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     *
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        // TODO: Implement next() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     *
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        // TODO: Implement key() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     *
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     *       Returns true on success or false on failure.
     */
    public function valid()
    {
        // TODO: Implement valid() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     *
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

    /**
     * @return mixed
     */
    public function currentAge() : Integer
    {
        // TODO: Implement currentAge() method.
    }

    /**
     * @return mixed
     */
    public function currentGivenName() : GivenName
    {
        // TODO: Implement currentGivenName() method.
    }

    /**
     * @return mixed
     */
    public function currentFamilyName() : FamilyName
    {
        // TODO: Implement currentFamilyName() method.
    }

    /**
     * @return mixed
     */
    public function currentGender() : Gender
    {
        // TODO: Implement currentGender() method.
    }

    /**
     * @return mixed
     */
    public function currentResidence() : Address
    {
        // TODO: Implement currentResidence() method.
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     *
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     *       </p>
     *       <p>
     *       The return value is cast to an integer.
     */
    public function count()
    {
        // TODO: Implement count() method.
    }

}