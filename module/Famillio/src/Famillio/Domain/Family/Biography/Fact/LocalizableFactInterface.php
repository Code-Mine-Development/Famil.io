<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 16:12
 */

namespace Famillio\Domain\Family\Biography\Fact;
use Famillio\Domain\Family\ValueObject\Location\Location;

/**
 * Interface LocalizableFactInterface
 *
 * @package Famillio\Domain\Family\Biography\Fact
 */
interface LocalizableFactInterface
{
    /**
     * @return \Famillio\Domain\Family\ValueObject\Location\Location
     */
    public function location() : Location;
}