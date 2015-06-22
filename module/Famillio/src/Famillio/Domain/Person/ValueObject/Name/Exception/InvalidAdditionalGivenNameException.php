<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 22:37
 */

namespace Famillio\Domain\Person\ValueObject\Name\Exception;


use AGmakonts\STL\Number\Integer;

/**
 * Class InvalidAdditionalGivenNameException
 *
 * @package Famillio\Domain\Person\ValueObject\Name\Exception
 */
class InvalidAdditionalGivenNameException extends \DomainException
{
    const MESSAGE_FORMAT = 'Additional name is not valid Name instance';

    /**
     *
     */
    public function __construct()
    {
        $this->message = self::MESSAGE_FORMAT;
    }
}