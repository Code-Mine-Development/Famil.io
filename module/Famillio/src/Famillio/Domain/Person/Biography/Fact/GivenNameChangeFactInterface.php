<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 18:23
 */

namespace Famillio\Domain\Person\Biography\Fact;

use Famillio\Domain\Person\ValueObject\Name\GivenName;

/**
 * Interface GivenNameChangeFactInterface
 *
 * @package Famillio\Domain\Person\Biography\Fact
 */
interface GivenNameChangeFactInterface
{
    public function givenName() : GivenName;
}