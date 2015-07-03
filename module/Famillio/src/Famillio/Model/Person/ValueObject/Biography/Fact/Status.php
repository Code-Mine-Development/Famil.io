<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 21/06/15
 * Time: 15:21
 */

namespace Famillio\Model\Person\ValueObject\Biography\Fact;


use AGmakonts\STL\Structure\AbstractEnum;

/**
 * Class Status
 *
 * @package Famillio\Model\Person\ValueObject\Biography\Fact
 */
class Status extends AbstractEnum
{
    /*
     * Current Facts are those ones that are actively used to provide
     * Data from Biography
     */
    const CURRENT = 'CURRENT';

    /*
     * Removed facts no longer can be used for any data processing.
     * Serve just as a history point
     */
    const REMOVED = 'REMOVED';

    /*
     * Replaced facts are technically removed but contain reference to new
     * Fact that replaced it
     */
    const REPLACED = 'REPLACED';
}