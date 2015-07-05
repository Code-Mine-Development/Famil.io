<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 03/07/15
 * Time: 14:47
 */

namespace Famillio\Model\Account;


use AGmakonts\DddBricks\Entity\EntityInterface;
use AGmakonts\STL\DateTime\DateTime;
use Famillio\Model\Account\Collection\IdentityCollectionInterface;

/**
 * Interface AccountInterface
 *
 * @package Famillio\Model\Account
 */
interface AccountInterface extends EntityInterface
{
    /**
     *
     * @return \Famillio\Model\Account\Collection\IdentityCollectionInterface
     */
    public function identities() : IdentityCollectionInterface;

    public function creationTime() : DateTime
}