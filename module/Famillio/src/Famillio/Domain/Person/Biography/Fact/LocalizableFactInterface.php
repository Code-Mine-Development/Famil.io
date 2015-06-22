<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 16:12
 */

namespace Famillio\Domain\Person\Biography\Fact;
use Famillio\Domain\Person\ValueObject\Location\Location;

/**
 * Interface LocalizableFactInterface
 *
 * @package Famillio\Domain\Person\Biography\Fact
 */
interface LocalizableFactInterface
{
    /**
     * @return \Famillio\Domain\Person\ValueObject\Location\Location
     */
    public function location() : Location;
}