<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 20:20
 */

namespace Famillio\Domain\Family\Collection\Biography;


use AGmakonts\STL\Structure\AbstractEnum;

/**
 * Class MergeMode
 *
 * @package Famillio\Domain\Family\Collection\Biography
 */
class MergeMode extends AbstractEnum
{
    const KEEP_ORIGINAL = 0;
    const KEEP_NEW      = 1;
    const ABORT         = 2;
}