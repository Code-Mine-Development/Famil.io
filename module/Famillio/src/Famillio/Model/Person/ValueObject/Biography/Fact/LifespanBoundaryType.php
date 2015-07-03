<?php
/**
 * Date:   11/06/15
 * Time:   15:55
 * 
 */

namespace Famillio\Model\Person\ValueObject\Biography\Fact;


use AGmakonts\STL\Structure\AbstractEnum;

/**
 * Class LifespanBoundaryType
 *
 * @package Famillio\Model\Person\ValueObject\Biography\Fact
 */
class LifespanBoundaryType extends AbstractEnum
{
    const BEGINNING = 'BEGINNING';
    const END       = 'END';
}