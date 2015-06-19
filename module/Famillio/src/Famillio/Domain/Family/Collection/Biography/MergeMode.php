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
 * Merge Mode enum is used to decide what should happen
 * when duplicate is found during merge of two Biographies.
 *
 * @package Famillio\Domain\Family\Collection\Biography
 */
class MergeMode extends AbstractEnum
{
    /*
     * Keep duplicated Fact from original Biography
     */
    const KEEP_ORIGINAL = 0;

    /*
     * Replace original Fact with the one from second Biography
     */
    const KEEP_NEW = 1;

    /*
     * Abort operation of merging
     */
    const ABORT = 2;
}