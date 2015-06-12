<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 16:22
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact\Exception;

/**
 * Class InvalidTokenException
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact\Exception
 */
class InvalidTokenException extends \RuntimeException
{
    const MESSAGE_FORMAT = 'Token (%s) is not in valid format';

    /**
     * @param string $token
     */
    public function __construct($token)
    {
        $this->message = sprintf(self::MESSAGE_FORMAT, $token);
    }
}