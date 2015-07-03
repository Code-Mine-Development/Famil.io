<?php
/**
 * Date:   11/06/15
 * Time:   15:54
 * 
 */

namespace Famillio\Model\Person\Biography\Fact;

/**
 * Interface LifespanBoundaryFactInterface
 *
 * @package Famillio\Model\Person\Biography\Fact
 */
interface LifespanBoundaryFactInterface
{
    /**
     * @return mixed
     */
    public function lifespanBoundaryType() : LifespanBoundaryType;
}