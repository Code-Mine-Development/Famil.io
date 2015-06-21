<?php
/**
 * Date:   11/06/15
 * Time:   15:55
 * 
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact;


use AGmakonts\STL\Structure\AbstractEnum;

/**
 * Class LifespanBoundaryType
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact
 */
class LifespanBoundaryType extends AbstractEnum
{
    const BEGINNING = 'BEGINNING';
    const END       = 'END';
}