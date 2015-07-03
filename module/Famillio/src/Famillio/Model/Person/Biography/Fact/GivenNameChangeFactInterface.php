<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 18:23
 */

namespace Famillio\Model\Person\Biography\Fact;

use Famillio\Model\Person\ValueObject\Name\GivenName;

/**
 * Interface GivenNameChangeFactInterface
 *
 * @package Famillio\Model\Person\Biography\Fact
 */
interface GivenNameChangeFactInterface
{
    public function givenName() : GivenName;
}