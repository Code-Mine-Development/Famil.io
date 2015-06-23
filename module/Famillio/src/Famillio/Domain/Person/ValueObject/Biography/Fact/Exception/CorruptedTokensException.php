<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 16:29
 */

namespace Famillio\Domain\Person\ValueObject\Biography\Fact\Exception;

/**
 * Class CorruptedTokensException
 *
 * @package Famillio\Domain\Person\ValueObject\Biography\Fact\Exception
 */
class CorruptedTokensException extends DomainException
{
    const MESSAGE_FORMAT = 'One of the tokens is corrupted';

    /**
     *
     */
    public function __construct()
    {
        $this->message = self::MESSAGE_FORMAT;
    }
}