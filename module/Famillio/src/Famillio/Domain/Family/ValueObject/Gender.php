<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 12:28
 */

namespace Famillio\Domain\Family\ValueObject;


use AGmakonts\STL\Structure\AbstractEnum;

/**
 * Class Gender
 *
 * @package Famillio\Domain\Famillio\ValueObject
 */
class Gender extends AbstractEnum
{
    const MALE = 'male';
    const FEMALE = 'female';
}