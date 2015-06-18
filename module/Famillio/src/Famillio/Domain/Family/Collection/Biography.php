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
use Famillio\Domain\Family\Collection\Exception\ModificationPreconditionException;
use Famillio\Domain\Family\Collection\Exception\UnknownFactRemovalAttemptException;
use Famillio\Domain\Family\Collection\Preconditions\Biography\Replacement\Remove;
use Famillio\Domain\Family\Collection\Preconditions\Biography\Replacement\Replacement;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier;
use Famillio\Domain\Family\ValueObject\Biography\Specification;
use Famillio\Domain\Family\ValueObject\Gender;
use Famillio\Domain\Family\ValueObject\Name\FamilyName;
use Famillio\Domain\Family\ValueObject\Name\GivenName;

/**
 * Class Biography
 *
 * Biography is specialized collection class that can store Facts.
 * All elements of the collection are stored in queue in order of
 * the Fact occurrence, not addition to the Collection.
 *
 * Biographies can be merged together or filtered. Both of those operations
 * will yeld new Collection object.
 *
 * Biographies can be iterated and counted.
 *
 * @package Famillio\Domain\Family\Collection
 */
class Biography implements BiographyInterface
{
    /**
     * Priority queue that holds all Facts. Timestamo of the Fact occurrence is used as
     * priority to determine order of elements.
     *
     * @var \SplPriorityQueue
     */
    private $factsTimeline;

    /**
     * Helper collection of Fact Identifiers used for fast lookup of existing
     * Facts.
     *
     * @var \SplObjectStorage
     */
    private $factIdentifiers;


    /**
     * Biography constructor.
     */
    public function __construct()
    {
        $this->factsTimeline   = new \SplPriorityQueue();
        $this->factIdentifiers = new \SplObjectStorage();

    }

    /**
     * Adds a fact to the collection. If Fact is already present exception will be thrown.
     * Determination if fact already exists or not is done by comparing provided Fact's Identifier
     * with Identifiers already known.
     *
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface $fact
     *
     * @throws \Famillio\Domain\Family\Collection\Exception\DuplicatedFactAdditionAttemptException
     */
    public function addFact(FactInterface $fact)
    {
        /*
         * Throw exception on duplication.
         */
        if (TRUE === $this->factIdentifiers()->contains($fact->identity())) {
            throw new DuplicatedFactAdditionAttemptException($fact);
        }

        /*
         * Add fact to ordered queue and to fast lookup helper collection.
         */
        $this->facts()->insert($fact, $fact->date()->getTimestamp()->value());
        $this->factIdentifiers()->attach($fact->identity(), $fact);
    }

    /**
     * @return \SplObjectStorage
     */
    private function factIdentifiers() : \SplObjectStorage
    {
        return $this->factIdentifiers;
    }


    /**
     * @return \SplPriorityQueue
     */
    private function facts() : \SplPriorityQueue
    {
        return $this->factsTimeline;
    }

    /**
     * Will remove Fact that has provided Identifier form collection.
     * If provided Identifier is unknown to the collection PreconditionException will be
     * thrown. Exception will hold information about failure cause.
     *
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier $identifier
     */
    public function removeFact(Identifier $identifier)
    {
        /*
         * Use internal method to modify the collection
         */
        $this->changeFactInTimeline($identifier);

        /*
         * Update lookup collection to reflect new state
         */
        $this->factIdentifiers()->detach($identifier);
    }

    /**
     * Will replace Fact that has provided $identifier with provided Fact object.
     * If collection doesn't have Fact that can be identified by provided Identifier
     * or new Fact has different date or type from previous one PreconditionException will
     * be thrown. Exception will hold details about the failure.
     *
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier $identifier
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface          $factInterface \
     */
    public function replaceFact(Identifier $identifier, FactInterface $factInterface)
    {
        /*
         * Use internal method to alter collection
         */
        $this->changeFactInTimeline($identifier, $factInterface);

        /*
         * Update lookup collection
         */
        $this->factIdentifiers()->detach($identifier);
        $this->factIdentifiers()->attach($factInterface->identity());

    }

    /**
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier $identifier
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface|NULL     $replaceWith
     *
     * @throws UnknownFactRemovalAttemptException
     * @throws ModificationPreconditionException
     */
    private function changeFactInTimeline(Identifier $identifier, FactInterface $replaceWith = NULL)
    {
        /*
         * If provided identifier is unknown throw exception
         */
        if (FALSE === $this->factIdentifiers()->contains($identifier)) {
            throw new UnknownFactRemovalAttemptException($identifier);
        }

        /*
         * Counter of failed precondition checks. After the process this should have value
         * of queue elements at the beginning -1
         */
        $failedPreconditionCount = 0;

        /*
         * Setup new, empty priority queue that will replace current one after the process is
         * done. Step is needed because there is no way of altering existing queue due to nature of
         * this data structure.
         */
        $newFactTimeline = new \SplPriorityQueue();

        /*
         * To reconstruct the queue we need original priorities
         */
        $this->facts()->setExtractFlags(\SplPriorityQueue::EXTR_BOTH);


        /*
         * Iterate over all Facts in the queue to find the one that should be
         * removed or replaced.
         */
        foreach ($this->facts() as $fact) {

            /*
             * Extract data from queue element
             */
            /** @var \Famillio\Domain\Family\Biography\Fact\FactInterface $factObject */
            $factObject = $fact['data'];
            $factDate   = $fact['priority'];

            /*
             * Setup preconditions that will be used to determine whether remove Fact or
             * replace it with provided one.
             */
            $removePrecondition  = new Remove($factObject, $replaceWith, $identifier);
            $replacePrecondition = new Replacement($factObject, $replaceWith, $identifier);

            /*
             * Test preconditions.
             */
            if (TRUE === $removePrecondition->isMeet()) {

                /*
                 * Skip elements that should be removed
                 */
                continue;

            } elseif (TRUE === $replacePrecondition->isMeet()) {

                /*
                 * Overwrite variable that holds current Fact with new one
                 */
                $factObject = $replaceWith;

            } else {

                /*
                 * Record fact that all preconditions failed
                 */
                $failedPreconditionCount++;

            }

            /*
             * Insert element to new queue. $factObject variable will hold
             * old Fact if no preconditions were met or new Fact object if it
             * was overwritten
             */
            $newFactTimeline->insert($factObject, $factDate);
        }

        /*
         * Check if *EXACTLY* one precondition was meet during entire process.
         *
         * If the number of failed preconditions is smaller then number of all
         * facts -1 (minus one) or those are the same it means that something
         * went wrong. In that case exception will be thrown.
         */
        if ($failedPreconditionCount !== $this->facts()->count() - 1) {
            throw new ModificationPreconditionException();
        }

        /*
         * Replace queues and rewind new one just to be sure that everything is ok.
         */
        $this->factsTimeline = $newFactTimeline;
        $this->facts()->rewind();
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