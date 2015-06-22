<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 18:28
 */

namespace Famillio\Domain\Person\Biography\Fact;


use Famillio\Domain\Person\ValueObject\Name\FamilyName;

/**
 * Interface FamilyNameChangeFactInterface
 *
 * @package Famillio\Domain\Person\Biography\Fact
 */
interface FamilyNameChangeFactInterface
{
    public function familyName() : FamilyName;
}