<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 16:12
 */

namespace Famillio\Domain\Family\Biography\Fact;
use Famillio\Domain\Family\ValueObject\Location\Address;

/**
 * Interface AddressChangeFactInterface
 *
 * @package Famillio\Domain\Family\Biography\Fact
 */
interface AddressChangeFactInterface extends LocalizableFactInterface
{
    /**
     * @return \Famillio\Domain\Family\ValueObject\Location\Address
     */
    public function address() : Address;
}