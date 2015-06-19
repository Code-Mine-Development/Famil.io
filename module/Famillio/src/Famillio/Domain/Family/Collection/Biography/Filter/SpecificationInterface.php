<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 15:45
 */

namespace Famillio\Domain\Family\Collection\Biography\Filter;

use Famillio\Domain\Family\Biography\Fact\FactInterface;

/**
 * Interface SpecificationInterface
 *
 * @package Famillio\Domain\Family\Collection\Biography\Filter
 */
interface SpecificationInterface
{
    /**
     * Check if provided Fact satisfies specification.
     *
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface $factInterface
     *
     * @return bool
     */
    public function isFactAcceptable(FactInterface $factInterface) : bool;

    /**
     * Attach another specification to the chain. All attached specifications will be
     * used and Fact will be accepted only if all of them are satisfied.
     *
     * @param \Famillio\Domain\Family\Collection\Biography\Filter\SpecificationInterface $specificationInterface
     *
     * @return void
     */
    public function attach(SpecificationInterface $specificationInterface);

    /**
     * Determine if specification can be attached to another. Specification provided in argument will
     * be a specification to witch current specification is being attached.
     *
     * @param \Famillio\Domain\Family\Collection\Biography\Filter\SpecificationInterface $specificationInterface
     *
     * @return bool
     */
    public function canBeAttachedTo(SpecificationInterface $specificationInterface) : bool;
}