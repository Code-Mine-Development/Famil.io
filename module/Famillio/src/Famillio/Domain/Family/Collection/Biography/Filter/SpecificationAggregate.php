<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 20/06/15
 * Time: 12:29
 */

namespace Famillio\Domain\Family\Collection\Biography\Filter;

use Famillio\Domain\Family\Biography\Fact\FactInterface;
use Famillio\Domain\Family\Collection\BiographyInterface;

/**
 * Class SpecificationAggregate
 *
 * Allows to attach multiple specifications and test them one by one.
 * This specification will accept the Fact only when all attached
 * Specifications will return positive results.
 *
 * @package Famillio\Domain\Family\Collection\Biography\Filter
 */
class SpecificationAggregate implements SpecificationInterface, ContextAwareSpecificationInterface
{
    /**
     *
     *
     * @var \SplObjectStorage
     */
    private $specifications;

    /**
     * Check if provided Fact satisfies specification.
     *
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface $factInterface
     *
     * @return bool
     */
    public function isFactAcceptable(FactInterface $factInterface) : bool
    {
        /*
         * Array of results returned from all child specifications
         */
        $results = [];

        /** @var \Famillio\Domain\Family\Collection\Biography\Filter\SpecificationInterface $specification */
        foreach ($this->specifications() as $specification) {

            /*
             * Add result of check to rest of them
             */
            $results[] = $specification->isFactAcceptable($factInterface);
        }

        /*
         * Check if results array doens't contain any falses
         */

        return (FALSE === in_array(FALSE, $results));

    }


    /**
     * Attach another specification to the chain. All attached specifications will be
     * used and Fact will be accepted only if all of them are satisfied.
     *
     * @param \Famillio\Domain\Family\Collection\Biography\Filter\SpecificationInterface $specificationInterface
     *
     * @return void
     */
    public function attach(SpecificationInterface $specificationInterface)
    {
        $this->specifications()->attach($specificationInterface);
    }

    /**
     * @return \SplObjectStorage
     */
    public function specifications() : \SplObjectStorage
    {
        return $this->specifications;
    }

    /**
     * Allows to specify collection instance that will be used as a context in witch
     * determination of specification satisfaction is made.
     *
     * @param \Famillio\Domain\Family\Collection\BiographyInterface $biographyInterface
     *
     * @return void
     */
    public function registerContext(BiographyInterface $biographyInterface)
    {
        /*
         * This specification doesn't itself hold the context, instead it is registered
         * in all child specifications.
         */
        foreach ($this->specifications() as $specification) {
            if ($specification instanceof ContextAwareSpecificationInterface) {
                $specification->registerContext($biographyInterface);
            }

        }
    }


}