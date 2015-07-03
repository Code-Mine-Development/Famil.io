<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 21/06/15
 * Time: 16:25
 */

namespace Famillio\Model\Person\Biography\Fact\Exception;

use Famillio\Model\Person\Biography\Fact\FactInterface;
use Famillio\Model\Person\ValueObject\Biography\Fact\Status;

/**
 * Class SameStatusException
 *
 * @package Famillio\Model\Person\Biography\Fact\Exception
 */
class InvalidStatusChangeAttemptException extends AbstractFactException
{
    const MESSAGE_FORMAT = 'Fact identified by %s has cannot have status changed to %s. %s';

    /**
     * @param \Famillio\Model\Person\Biography\Fact\FactInterface      $fact
     * @param \Famillio\Model\Person\ValueObject\Biography\Fact\Status $status
     * @param \Famillio\Model\Person\Biography\Fact\Exception\string   $reason
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