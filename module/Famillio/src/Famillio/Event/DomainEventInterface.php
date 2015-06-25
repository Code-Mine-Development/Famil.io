<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 25/06/15
 * Time: 23:58
 */

namespace Famillio\Event;

/**
 * Interface DomainEventInterface
 *
 * @package Famillio\Event
 */
interface DomainEventInterface
{
    /**
     * @return string
     */
    static public function name() : string;
}