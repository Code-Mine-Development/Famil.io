<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 22/06/15
 * Time: 04:12
 */

namespace Famillio\Domain\Family\Collection;

use AGmakonts\DddBricks\Collection\CollectionInterface;

/**
 * Interface FamilyInterface
 *
 * @package Famillio\Domain\Family\Collection
 */
interface FamilyInterface extends \Iterator, \Countable, CollectionInterface
{

}