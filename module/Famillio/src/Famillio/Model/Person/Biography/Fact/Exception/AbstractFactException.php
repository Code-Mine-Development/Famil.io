<?php
/**
 * Date:   11/06/15
 * Time:   15:14
 * 
 */

namespace Famillio\Model\Person\Biography\Fact\Exception;

use Famillio\Model\Person\Biography\Fact\FactInterface;

/**
 * Class AbstractFactException
 *
 * @package Famillio\Model\Person\Biography\Fact\Exception
 */
abstract class AbstractFactException extends DomainException
{
    private $fact;

    /**
     * @param \Famillio\Model\Person\Biography\Fact\FactInterface $fact
     */
    public function __construct(FactInterface $fact)
    {
        $this->fact = $fact;
    }

    /**
     * @return \Famillio\Model\Person\Biography\Fact\FactInterface
     */
    public function fact()
    {
        return $this->fact;
    }
}