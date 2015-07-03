<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 23/06/15
 * Time: 00:03
 */

namespace Famillio\Model\Person\Biography\Fact;

use Famillio\Model\Person\Biography\Fact\Validator\ValidatorInterface;

/**
 * Interface FussyFactInterface
 *
 * Fussy facts need to have their requirements satisfied in
 * order to coexist with different Facts. This interface provides method to
 * get validator that can check other Facts and determine if requirements are meet.
 *
 * @package Famillio\Model\Person\Biography\Fact
 */
interface FussyFactInterface
{
    /**
     * Returns instance of Validator that is setup in a way that can determine
     * if Facts that will be existing in the same collection are not conflicting.
     *
     * @return \Famillio\Model\Person\Biography\Fact\Validator\ValidatorInterface
     */
    public function validator() : ValidatorInterface;
}