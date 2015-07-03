<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 18:28
 */

namespace Famillio\Model\Person\Biography\Fact;


use Famillio\Model\Person\ValueObject\Name\FamilyName;

/**
 * Interface FamilyNameChangeFactInterface
 *
 * @package Famillio\Model\Person\Biography\Fact
 */
interface FamilyNameChangeFactInterface
{
    public function familyName() : FamilyName;
}