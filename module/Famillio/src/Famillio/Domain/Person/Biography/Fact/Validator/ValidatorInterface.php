<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 23/06/15
 * Time: 00:09
 */

namespace Famillio\Domain\Person\Biography\Fact\Validator;

use Famillio\Domain\Person\Biography\Fact\FactInterface;

/**
 * Interface ValidatorInterface
 *
 * @package Famillio\Domain\Person\Biography\Fact\Validator
 */
interface ValidatorInterface
{
    /**
     * Check if rested Fact doesn't coflict with validator's requirements
     *
     * @param \Famillio\Domain\Person\Biography\Fact\FactInterface $fact
     *
     * @return bool
     */
    public function isFactValid(FactInterface $fact) : bool;
}