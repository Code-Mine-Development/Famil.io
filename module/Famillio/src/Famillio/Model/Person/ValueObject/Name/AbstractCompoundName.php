<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 22:59
 */

namespace Famillio\Model\Person\ValueObject\Name;


use AGmakonts\STL\AbstractValueObject;
use AGmakonts\STL\String\Text;

/**
 * Class AbstractCompoundName
 *
 * @package Famillio\Model\Person\ValueObject\Name
 */
abstract class AbstractCompoundName extends AbstractValueObject
{
    /**
     * @param array $names
     *
     * @return bool
     */
    protected function isNameArrayValid(array $names)
    {
        $indexedNames = array_values($names);

        foreach ($indexedNames as $key => $additionalName) {
            if (FALSE === ($additionalName instanceof Name)) {
                return FALSE;
            }
        }

        return TRUE;
    }

    /**
     * @return String
     */
    abstract public function name() : Text;
}