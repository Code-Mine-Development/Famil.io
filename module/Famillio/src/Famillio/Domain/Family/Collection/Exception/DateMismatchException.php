<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 17:45
 */

namespace Famillio\Domain\Family\Collection\Exception;

use Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier;

/**
 * Class DateMismatchException
 *
 * @package Famillio\Domain\Family\Collection\Exception
 */
class DateMismatchException extends InvalidArgumentException
{
    const MESSAGE_FORMAT = 'Fact to replace has different date (%s) than replacing one (%s).';

    /**
     * DateMismatchException constructor.
     *
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier $identifier
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Identifier $replacingIdentifier
     */
    public function __construct(Identifier $identifier, Identifier $replacingIdentifier)
    {
        $this->message = sprintf(
            self::MESSAGE_FORMAT,
            $identifier->date()->value(),
            $replacingIdentifier->date()->value());
    }


}