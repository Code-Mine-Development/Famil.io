<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 15:20
 */

namespace Famillio\Domain\Person\Collection\Exception;

use Famillio\Domain\Person\Biography\Fact\FactInterface;
use Famillio\Domain\Person\ValueObject\Biography\Fact\Identifier;

/**
 * Class UnknownFactRemovalAttemptException
 *
 * @package Famillio\Domain\Person\Collection\Exception
 */
class UnknownFactRemovalAttemptException extends InvalidArgumentException
{
    const MESSAGE_FORMAT = 'Fact identifier by %s is not member of the Biography';

    /**
     * UnknownFactRemovalAttemptException constructor.
     *
     * @param \Famillio\Domain\Person\ValueObject\Biography\Fact\Identifier $identifier
     */
    public function __construct(Identifier $identifier)
    {
        $this->message = sprintf(self::MESSAGE_FORMAT, $identifier->value());
    }


}