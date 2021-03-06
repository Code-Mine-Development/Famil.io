<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 18:23
 */

namespace Famillio\Model\Person\Collection\Preconditions\Biography\Replacement;


use Famillio\Model\Person\Biography\Fact\FactInterface;
use Famillio\Model\Person\Collection\Preconditions\PreconditionInterface;
use Famillio\Model\Person\ValueObject\Biography\Fact\Identifier;

/**
 * Class AbstractReplacementPrecondition
 *
 * @package Famillio\Model\Person\Collection\Preconditions\Biography\Replacement
 */
abstract class AbstractReplacementPrecondition implements PreconditionInterface
{

    /**
     * @var \Famillio\Model\Person\Biography\Fact\FactInterface
     */
    private $oldFact;

    /**
     * @var \Famillio\Model\Person\Biography\Fact\FactInterface
     */
    private $newFact;

    /**
     * @var \Famillio\Model\Person\ValueObject\Biography\Fact\Identifier
     */
    private $identifier;

    /**
     * AbstractReplacementPrecondition constructor.
     *
     * @param \Famillio\Model\Person\Biography\Fact\FactInterface          $oldFact
     * @param \Famillio\Model\Person\Biography\Fact\FactInterface          $newFact
     * @param \Famillio\Model\Person\ValueObject\Biography\Fact\Identifier $identifier
     */
    final public function __construct(FactInterface $oldFact = NULL,
                                      FactInterface $newFact = NULL,
                                      Identifier $identifier = NULL)
    {
        $this->oldFact    = $oldFact;
        $this->newFact    = $newFact;
        $this->identifier = $identifier;
    }

    /**
     * @return FactInterface
     */
    protected function oldFact()
    {
        return $this->oldFact;
    }

    /**
     * @return FactInterface
     */
    protected function newFact()
    {
        return $this->newFact;
    }

    /**
     * @return Identifier
     */
    protected function identifier()
    {
        return $this->identifier;
    }
}