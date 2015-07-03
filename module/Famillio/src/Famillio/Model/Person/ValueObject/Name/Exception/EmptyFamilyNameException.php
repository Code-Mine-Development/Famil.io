<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 11:12
 */

namespace Famillio\Model\Person\ValueObject\Name\Exception;

/**
 * Class EmptyFamilyNameException
 *
 * @package Famillio\Model\Person\ValueObject\Name\Exception
 */
class EmptyFamilyNameException extends \DomainException
{
    const MESSAGE_FORMAT = 'Family name needs to be composed of at least one name element';

    /**
     *
     */
    public function __construct()
    {
        $this->message = self::MESSAGE_FORMAT;
    }
}