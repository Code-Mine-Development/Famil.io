<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 23/06/15
 * Time: 12:17
 */

namespace Famillio\Model\Person\Collection\Exception;

use Famillio\Model\Person\ValueObject\Biography\Fact\Identifier;

/**
 * Class UnacceptableFactException
 *
 * @package Famillio\Model\Person\Collection\Exception
 */
class UnacceptableFactException extends DomainException
{
    const MESSAGE_FORMAT = 'Fact identified by %s cannot be accepted by one identified by %s';

    /**
     * UnacceptableFactException constructor.
     *
     * @param \Famillio\Model\Person\ValueObject\Biography\Fact\Identifier $identifier
     * @param \Famillio\Model\Person\ValueObject\Biography\Fact\Identifier $blocker
     */
    public function __construct(Identifier $identifier, Identifier $blocker)
    {
        $this->message = sprintf(self::MESSAGE_FORMAT, $identifier->value(), $blocker->value());
    }


}