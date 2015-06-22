<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 21/06/15
 * Time: 16:25
 */

namespace Famillio\Domain\Person\Biography\Fact\Exception;

use Famillio\Domain\Person\Biography\Fact\FactInterface;
use Famillio\Domain\Person\ValueObject\Biography\Fact\Status;

/**
 * Class SameStatusException
 *
 * @package Famillio\Domain\Person\Biography\Fact\Exception
 */
class InvalidStatusChangeAttemptException extends AbstractFactException
{
    const MESSAGE_FORMAT = 'Fact identified by %s has cannot have status changed to %s. %s';

    /**
     * @param \Famillio\Domain\Person\Biography\Fact\FactInterface      $fact
     * @param \Famillio\Domain\Person\ValueObject\Biography\Fact\Status $status
     * @param \Famillio\Domain\Person\Biography\Fact\Exception\string   $reason
     */
    public function __construct(FactInterface $fact, Status $status, string $reason)
    {
        parent::__construct($fact);

        $this->message = sprintf(
            self::MESSAGE_FORMAT,
            $fact->identity()->value(),
            $status->value(),
            $reason)
        ;
    }
}