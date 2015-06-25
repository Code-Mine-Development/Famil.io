<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 25/06/15
 * Time: 23:42
 */

namespace Famillio\Event;

use AGmakonts\STL\Structure\AbstractEnum;

/**
 * Class Type
 *
 * @package Famillio\Event
 */
class Type extends AbstractEnum
{
    const PRE      = -1;
    const SINGULAR = 0;
    const POST     = 1;
}