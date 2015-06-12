<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 18:28
 */

namespace Famillio\Domain\Family\Biography\Fact;


use Famillio\Domain\Family\ValueObject\Name\FamilyName;

interface FamilyNameChangeFactInterface
{
    public function familyName() : FamilyName;
}