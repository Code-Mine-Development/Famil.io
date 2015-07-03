<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 11:14
 */

namespace Famillio\Model\Person\Collection\Biography\DataExtractor;


use AGmakonts\STL\ValueObjectInterface;
use Famillio\Model\Person\Biography\Fact\FactInterface;
use Famillio\Model\Person\Collection\Biography\DataExtractor\Exception\NotAExtractorInterface;

/**
 * Class DataExtractorAggregate
 *
 * Aggregates different data extractors and allows for extraction of multiple
 * values during single run.
 *
 * All classes that implement DataExctractorInterface can be registered as
 * child extractors.
 *
 * @package Famillio\Model\Person\Collection\Biography\DataExtractor
 */
class DataExtractorAggregate implements DataExtractorInterface
{
    /**
     * @var \SplObjectStorage
     */
    private $extractors;

    /**
     * DataExtractorAggregate constructor.
     *
     * @param $extractors
     */
    public function __construct(array $extractors)
    {
        $this->extractors = new \SplObjectStorage();

        /*
         * Iterate over all elements of provided array
         * and check if all of them are proper data extractors
         */
        foreach ($extractors as $extractor) {

            if(FALSE === ($extractor instanceof DataExtractorInterface)) {
                throw new NotAExtractorInterface($extractor);
            }

            $this->registerExtractor($extractor);
        }
    }

    /**
     * @param \Famillio\Model\Person\Collection\Biography\DataExtractor\DataExtractorInterface $dataExtractorInterface
     */
    public function registerExtractor(DataExtractorInterface $dataExtractorInterface)
    {
        $this->extractors()->attach($dataExtractorInterface);
    }


    /**
     * @param \Famillio\Model\Person\Biography\Fact\FactInterface $factInterface
     *
     * @return void
     */
    public function registerFact(FactInterface $factInterface)
    {
        /** @var \Famillio\Model\Person\Collection\Biography\DataExtractor\DataExtractorInterface $extractor */
        foreach ($this->extractors() as $extractor) {
            $extractor->registerFact($factInterface);
        }
    }

    /**
     * @return bool
     */
    public function isSatisfied() : bool
    {
        $satisfied = [];

        /*
         * Iterate over all extractors and check if those are
         * satisfied
         */
        /** @var \Famillio\Model\Person\Collection\Biography\DataExtractor\DataExtractorInterface $extractor */
        foreach ($this->extractors() as $extractor) {
            /*
             * Record extractor result
             */
            $satisfied[] = $extractor->isSatisfied();
        }

        return (FALSE === in_array(FALSE, $satisfied));
    }

    /**
     * @return \AGmakonts\STL\ValueObjectInterface
     */
    public function data() : ValueObjectInterface
    {
        // exception
    }

    /**
     * @return \SplObjectStorage
     */
    public function extractors() : \SplObjectStorage
    {
        return $this->extractors;
    }

}