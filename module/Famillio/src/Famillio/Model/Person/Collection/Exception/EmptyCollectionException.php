<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 11:35
 */

namespace Famillio\Model\Person\Collection\Exception;

/**
 * Class EmptyCollectionException
 *
 * @package Famillio\Model\Person\Collection\Exception
 */
class EmptyCollectionException extends BadMethodCallException
{
    const MASSAGE_FORMAT = 'Cannot invoke %s on empty collection';

    /**
     * EmptyCollectionException constructor.
     *
     * @param string $method
     */
    public function __construct(string $method)
    {
        $this->message = sprintf(self::MASSAGE_FORMAT, $method);
    }


}