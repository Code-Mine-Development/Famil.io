<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 12:27
 */

namespace Famillio\Domain\Family\Biography\Fact;


use Famillio\Domain\Family\ValueObject\Gender;

/**
 * Interface GenderChangeFactInterface
 *
 * @package Famillio\Domain\Family\Biography\Fact
 */
interface GenderChangeFactInterface
{
    /**
     * @return Gender
     */
    public function gender() : Gender;
}