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
}