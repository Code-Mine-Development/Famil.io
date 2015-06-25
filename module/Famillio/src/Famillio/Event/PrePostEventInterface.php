<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 26/06/15
 * Time: 00:45
 */

namespace Famillio\Event;

/**
 * Interface PrePostEventInterface
 *
 * @package Famillio\Event
 */
interface PrePostEventInterface
{
    /**
     * @return \Famillio\Event\SplitType
     */
    public function splitType() : SplitType;
}