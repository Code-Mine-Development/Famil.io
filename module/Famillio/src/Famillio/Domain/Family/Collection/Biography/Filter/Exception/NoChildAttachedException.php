<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 18:55
 */

namespace Famillio\Domain\Family\Collection\Biography\Filter\Exception;

/**
 * Class NoChildAttachedException
 *
 * @package Famillio\Domain\Family\Collection\Biography\Filter\Exception
 */
class NoChildAttachedException extends BadMethodCallException
{
    const MESSAGE_FORMAT = 'Specification doesn\'t have children attached';

    /**
     * NoChildAttachedException constructor.
     */
    public function __construct()
    {
        $this->message = self::MESSAGE_FORMAT;
    }


}