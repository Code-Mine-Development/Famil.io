<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 22/06/15
 * Time: 04:12
 */

namespace Famillio\Domain\Person\Collection;

use AGmakonts\DddBricks\Collection\CollectionInterface;
use Famillio\Domain\Person\Person;

/**
 * Interface FamilyInterface
 *
 * @package Famillio\Domain\Person\Collection
 */
interface FamilyInterface extends \Iterator, \Countable, CollectionInterface
{
    public function addMember(Person $person);

    public function removeMember();
}