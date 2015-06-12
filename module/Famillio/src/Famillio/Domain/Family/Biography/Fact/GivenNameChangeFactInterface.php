<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 18:23
 */

namespace Famillio\Domain\Family\Biography\Fact;

use Famillio\Domain\Family\ValueObject\Name\GivenName;

/**
 * Interface GivenNameChangeFactInterface
 *
 * @package Famillio\Domain\Family\Biography\Fact
 */
interface GivenNameChangeFactInterface
{
    public function givenName() : GivenName;
}