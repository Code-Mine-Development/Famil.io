<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 12:27
 */

namespace Famillio\Model\Person\Biography\Fact;


use Famillio\Model\Person\ValueObject\Gender;

/**
 * Interface GenderChangeFactInterface
 *
 * @package Famillio\Model\Person\Biography\Fact
 */
interface GenderChangeFactInterface
{
    /**
     * @return Gender
     */
    public function gender() : Gender;
}