<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 16:12
 */

namespace Famillio\Model\Person\Biography\Fact;
use Famillio\Model\Person\ValueObject\Location\Location;

/**
 * Interface LocalizableFactInterface
 *
 * @package Famillio\Model\Person\Biography\Fact
 */
interface LocalizableFactInterface
{
    /**
     * @return \Famillio\Model\Person\ValueObject\Location\Location
     */
    public function location() : Location;
}