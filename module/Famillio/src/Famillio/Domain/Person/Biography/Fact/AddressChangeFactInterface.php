<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 16:12
 */

namespace Famillio\Domain\Person\Biography\Fact;
use Famillio\Domain\Person\ValueObject\Location\Address;

/**
 * Interface AddressChangeFactInterface
 *
 * Facts that provide information about Address change will be
 * used to set current residence of person holding Biography
 * that stores this kind of a Fact
 *
 * @package Famillio\Domain\Person\Biography\Fact
 */
interface AddressChangeFactInterface extends LocalizableFactInterface
{
    /**
     * Returns Address object
     *
     * @return \Famillio\Domain\Person\ValueObject\Location\Address
     */
    public function address() : Address;
}