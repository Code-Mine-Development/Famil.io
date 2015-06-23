<?php
/**
 * Date:   11/06/15
 * Time:   15:14
 * 
 */

namespace Famillio\Domain\Person\Biography\Fact\Exception;

use Famillio\Domain\Person\Biography\Fact\FactInterface;

/**
 * Class AbstractFactException
 *
 * @package Famillio\Domain\Person\Biography\Fact\Exception
 */
abstract class AbstractFactException extends DomainException
{
    private $fact;

    /**
     * @param \Famillio\Domain\Person\Biography\Fact\FactInterface $fact
     */
    public function __construct(FactInterface $fact)
    {
        $this->fact = $fact;
    }

    /**
     * @return \Famillio\Domain\Person\Biography\Fact\FactInterface
     */
    public function fact()
    {
        return $this->fact;
    }
}