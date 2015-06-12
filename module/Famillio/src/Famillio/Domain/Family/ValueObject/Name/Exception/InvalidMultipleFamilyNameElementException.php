<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 23:12
 */

namespace Famillio\Domain\Family\ValueObject\Name\Exception;

/**
 * Class InvalidMultipleFamilyNameElementException
 *
 * @package Famillio\Domain\Family\ValueObject\Name\Exception
 */
class InvalidMultipleFamilyNameElementException extends \DomainException
{
    const MESSAGE_FORMAT = 'Invalid element in multiple name family name';

    /**
     *
     */
    public function __construct()
    {
        $this->message = self::MESSAGE_FORMAT;
    }

}