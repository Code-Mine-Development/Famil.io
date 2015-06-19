<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 18:50
 */

namespace Famillio\Domain\Family\Collection\Biography\Filter;

use Famillio\Domain\Family\Collection\Biography\Filter\Exception\NoChildAttachedException;

/**
 * Class AbstractSpecification
 *
 * @package Famillio\Domain\Family\Collection\Biography\Filter
 */
abstract class AbstractSpecification implements SpecificationInterface
{
    /**
     * @var \Famillio\Domain\Family\Collection\Biography\Filter\SpecificationInterface
     */
    private $childSpecification;

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
        try {
            /*
             * If child is already specified attach specification passed in
             * argument as it's child spec.
             */
            $child = $this->child();
            $child->attach($specificationInterface);

        } catch (NoChildAttachedException $exception) {

            /*
             * If exception was thrown it means that no child was specified
             * Attaching child to current specification.
             */
            $this->childSpecification = $specificationInterface;
        }
    }

    /**
     * @return \Famillio\Domain\Family\Collection\Biography\Filter\SpecificationInterface
     */
    protected function child() : SpecificationInterface
    {
        /*
         * If no child is specified throw exception (cannot return NULL)
         */
        if(NULL === $this->childSpecification) {
            throw new NoChildAttachedException();
        }

        return $this->childSpecification;
    }

}