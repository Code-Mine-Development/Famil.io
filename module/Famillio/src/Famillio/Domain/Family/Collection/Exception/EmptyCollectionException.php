<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 11:35
 */

namespace Famillio\Domain\Family\Collection\Exception;

/**
 * Class EmptyCollectionException
 *
 * @package Famillio\Domain\Family\Collection\Exception
 */
class EmptyCollectionException extends BadMethodCallException
{
    const MASSAGE_FORMAT = 'Cannot invoke %s on empty collection';

    /**
     * EmptyCollectionException constructor.
     */
    public function __construct(string $method)
    {
        $this->message = sprintf(self::MASSAGE_FORMAT, $method);
    }


}