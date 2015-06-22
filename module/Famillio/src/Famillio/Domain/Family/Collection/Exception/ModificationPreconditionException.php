<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 19:34
 */

namespace Famillio\Domain\Family\Collection\Exception;

/**
 * Class ModificationPreconditionException
 *
 * @package Famillio\Domain\Family\Collection\Exception
 */
class ModificationPreconditionException extends BadMethodCallException
{

    const MESSAGE_FORMAT = 'No modifications were made to the collection';
    /**
     * ModificationPreconditionException constructor.
     */
    public function __construct()
    {
        $this->message = self::MESSAGE_FORMAT;
    }
}