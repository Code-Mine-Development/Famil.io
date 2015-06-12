<?php
/**
 * Date:   11/06/15
 * Time:   15:54
 * 
 */

namespace Famillio\Domain\Family\Biography\Fact;

interface LifespanBoundaryFactInterface
{
    /**
     * @return mixed
     */
    public function lifespanBoundaryType() : LifespanBoundaryType;
}