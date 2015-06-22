<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 23/06/15
 * Time: 00:37
 */

namespace Famillio\Domain\Person\Biography\Fact\Validator;

use Famillio\Domain\Person\Biography\Fact\FactInterface;

/**
 * Class Callback
 *
 * @package Famillio\Domain\Person\Biography\Fact\Validator
 */
class Callback implements ValidatorInterface
{
    /**
     * @var \Closure
     */
    private $callback;

    /**
     * Callback constructor.
     *
     * @param $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }


    /**
     * Check if rested Fact doesn't coflict with validator's requirements
     *
     * @param \Famillio\Domain\Person\Biography\Fact\FactInterface $fact
     *
     * @return bool
     */
    public function isFactValid(FactInterface $fact) : bool
    {
        $callback = $this->callback;
        return $callback($fact);
    }

}