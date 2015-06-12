<?php
/**
 * Date:   11/06/15
 * Time:   15:18
 * 
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact\Exception;


use AGmakonts\STL\String\String;
use Famillio\Domain\Family\ValueObject\Biography\Fact\AbstractFact;

/**
 * Class InvalidDescriptionException
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact\Exception
 */
class InvalidDescriptionException extends DomainException
{
    const MESSAGE_FORMAT = 'Fact description cannot be empty';

    /**
     *
     */
    public function __construct()
    {
        $this->message = self::MESSAGE_FORMAT;
    }

}