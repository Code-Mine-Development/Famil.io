<?php
/**
 * Date:   11/06/15
 * Time:   14:50
 *
 */

namespace Famillio\Domain\Family\Collection;

use Famillio\Domain\Family\Biography\Fact\FactInterface;
use Famillio\Domain\Family\Collection\Biography\DataExtractor\DataExtractorInterface;
use Famillio\Domain\Family\Collection\Biography\MergeMode;
use Famillio\Domain\Family\Collection\Exception\DuplicatedFactAdditionAttemptException;
use Famillio\Domain\Family\Collection\Exception\ModificationPreconditionException;
use Famillio\Domain\Family\Collection\Exception\UnknownFactRemovalAttemptException;
use Famillio\Domain\Family\Collection\Preconditions\Biography\Replacement\Remove;
use Famillio\Domain\Family\Collection\Preconditions\Biography\Replacement\Replacement;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier;
use Famillio\Domain\Family\ValueObject\Biography\Specification;


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
     * Priority queue that holds all Facts. Timestamp of the Fact occurrence is used as
     * priority to determine order of elements.
     *
     * Decision to use queue structure for storage is motivated by the fact (not the class)
     * that most of the operations require iteration over all elements. Exception from that rule
     * is only removal and replacement of Facts (yes, the class) in the collection.
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
     * Copy of the $factsTimeline that allows for iteration over the queue
     * for various reasons without taking elements of the original queue.
     *
     * @var \SplPriorityQueue
     */
    private $iterator;


    /**
     * Biography constructor.
     */
    public function __construct()
    {
        /*
         * Setup all properties to initial state
         */
        $this->factsTimeline   = new \SplPriorityQueue();
        $this->factIdentifiers = new \SplObjectStorage();
        $this->iterator        = new \SplPriorityQueue();

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
     * Returns list of all registered Fact identifiers.
     *
     * This collection cannot be relied on in terms of order.
     *
     * @return \SplObjectStorage
     */
    private function factIdentifiers() : \SplObjectStorage
    {
        return $this->factIdentifiers;
    }


    /**
     * Returns queue of all the facts stored in the collection
     *
     * @return \SplPriorityQueue
     */
    private function facts() : \SplPriorityQueue
    {
        return $this->factsTimeline;
    }

    /**
     * Return clone of the queue containing all Facts for processes
     * that are destructive to queue data.
     *
     * @return \SplPriorityQueue
     */
    private function factsIterator() : \SplPriorityQueue
    {
        return clone $this->facts();
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
     * Modifies the collection by removing or replacing Fact.
     *
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
     * Returns new Biography object that contains Facts from both (current and
     * passed as an argument) Biographies.
     *
     * Two processed biographies can have duplicated Facts. When duplicate is found
     * $mergeMode argument will be used to determine way of handling it. By default
     * duplicated Fact from original collection will be kept.
     *
     *
     * @param \Famillio\Domain\Family\Collection\BiographyInterface       $biography
     * @param \Famillio\Domain\Family\Collection\Biography\MergeMode|NULL $mergeMode
     *
     * @return \Famillio\Domain\Family\Collection\BiographyInterface
     */
    public function merged(BiographyInterface $biography, MergeMode $mergeMode = NULL) : BiographyInterface
    {
        /*
         * Fallback to default MergeMode if none was provided
         */
        if (NULL === $mergeMode) {
            $mergeMode = MergeMode::get(MergeMode::KEEP_ORIGINAL);
        }

        /*
         * Create new Biography that will be returned after merge process
         *
         * References after cloning are still references so instances of Fact
         * entities and ValueObjects stored in them won't be copied.
         */
        $newBiography = clone $this;

        /*
         * Iterate over all Facts from new collection that will be merged and try to
         * add Facts from it into cloned Biography that represents original collection.
         */
        /** @var \Famillio\Domain\Family\Biography\Fact\FactInterface $fact */
        foreach ($biography as $fact) {

            try {

                $newBiography->addFact($fact);
            } catch (DuplicatedFactAdditionAttemptException $exception) {

                /*
                 * When duplication exception is thrown duplicate handling logic comes into play.
                 */
                switch ($mergeMode) {

                    case MergeMode::get(MergeMode::KEEP_NEW) :
                        /*
                         * If merge mode is set to keeping new Fact replaceFact method is used
                         * to overwrite old one. This step is needed because duplicates are determined
                         * by identifier and there is slight possibility that two instances of the Fact
                         * entity will have different values.
                         */
                        $newBiography->replaceFact($fact->identity(), $fact);
                        break;
                    case MergeMode::get(MergeMode::ABORT) :
                        /*
                         * If merge mode is set to abort the procedure, caught exception is rethrown.
                         */
                        throw $exception;
                        break;
                    case MergeMode::get(MergeMode::KEEP_ORIGINAL) :
                        /*
                         * For merge mode that keeps original no more logic is needed, operation is not
                         * interrupted and new Fact is discarded.
                         */
                        break;
                    default:
                        break;
                }
            }
        }


        return $newBiography;

    }


    /**
     * @return \SplObjectStorage
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
     * Copy Fact queue in current state to allow for destructive processes that
     * are not stateless. Mainly used for methods of Iterator interface and for data extraction.
     */
    public function prepareIterator()
    {
        $this->iterator = $this->factsIterator();
    }

    /**
     * Returns copy of the Facts queue generated by call to ::prepareIterator
     *
     * @return \SplPriorityQueue
     */
    private function publicIterator()
    {
        return $this->iterator;
    }


    /**
     * Return the current element
     *
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        if(TRUE === $this->publicIterator()->isEmpty()) {
            $this->prepareIterator();
        }

        return $this->publicIterator()->current();
    }

    /**
     * Move forward to next element
     *
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        if(TRUE === $this->publicIterator()->isEmpty()) {
            $this->prepareIterator();
        }

        $this->publicIterator()->next();
    }

    /**
     * Return the key of the current element
     *
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        if(TRUE === $this->publicIterator()->isEmpty()) {
            $this->prepareIterator();
        }

        return $this->publicIterator()->key();
    }

    /**
     * Checks if current position is valid
     *
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     *       Returns true on success or false on failure.
     */
    public function valid()
    {
        if(TRUE === $this->publicIterator()->isEmpty()) {
            $this->prepareIterator();
        }

        return $this->publicIterator()->valid();
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->prepareIterator();
        $this->publicIterator()->rewind();
    }


    /**
     * Count of the Facts in the Biography
     *
     * @link http://php.net/manual/en/countable.count.php
     * @return int
     */
    public function count()
    {
        return $this->facts()->count();
    }

    /**
     * Extract data from Facts stored in Biography. Data Extractor object that will be used as argument
     * will be returned after satisfaction.
     *
     * @param \Famillio\Domain\Family\Collection\Biography\DataExtractor\DataExtractorInterface $dataExtractorInterface
     *
     * @return \Famillio\Domain\Family\Collection\Biography\DataExtractor\DataExtractorInterface
     */
    public function extractData(DataExtractorInterface $dataExtractorInterface) : DataExtractorInterface
    {
        /*
         * Get cpy of all the facts to not destroy original queue by iteration
         */
        $facts = $this->factsIterator();

        /** @var \Famillio\Domain\Family\Biography\Fact\FactInterface $fact */
        foreach ($facts as $fact) {

            /*
             * Pass Fact to data extractor for processing
             */
            $dataExtractorInterface->registerFact($fact);


            /*
             * If data extractor knows that all required data is already registered
             * It becomes satisfied and we can stop the loop.
             */
            if (TRUE === $dataExtractorInterface->isSatisfied()) {
                break;
            }
        }

        return $dataExtractorInterface;
    }


}