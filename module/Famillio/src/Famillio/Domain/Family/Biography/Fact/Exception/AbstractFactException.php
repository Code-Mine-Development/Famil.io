<?php
/**
 * Date:   11/06/15
 * Time:   15:14
 * 
 */

namespace Famillio\Domain\Family\Biography\Fact\Exception;

use Famillio\Domain\Family\Biography\Fact\FactInterface;

/**
 * Class AbstractFactException
 *
 * @package Famillio\Domain\Family\Biography\Fact\Exception
 */
abstract class AbstractFactException extends DomainException
{
    private $fact;

    /**
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface $fact
     */
    public function __construct(FactInterface $fact)
    {
        $this->fact = $fact;
    }

    public function fact()
    {
        return $this->fact;
    }
}