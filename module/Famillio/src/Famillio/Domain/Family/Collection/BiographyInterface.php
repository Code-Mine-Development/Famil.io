<?php
/**
 * Date:   11/06/15
 * Time:   14:50
 * 
 */

namespace Famillio\Domain\Family\Collection;

use Famillio\Domain\Family\Biography\Fact\AbstractFact;
use Famillio\Domain\Family\ValueObject\Biography\Specification;

interface BiographyInterface
{
    /**
     * @param \Famillio\Domain\Family\Biography\Fact\AbstractFact $fact
     *
     * @return mixed
     */
    public function addFact(AbstractFact $fact);

    /**
     * @param \Famillio\Domain\Family\Collection\BiographyInterface $biography
     *
     * @return mixed
     */
    public function merged(BiographyInterface $biography) : BiographyInterface;

    /**
     * @return mixed
     */
    public function timeline() : \SplObjectStorage;

    /**
     * @param \Famillio\Domain\Family\ValueObject\Biography\Specification $specification
     *
     * @return mixed
     */
    public function filtered(Specification $specification) : BiographyInterface;


    public function
}