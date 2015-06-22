<?php
/**
 * Date:   11/06/15
 * Time:   15:48
 * 
 */

namespace Famillio\Domain\Person\Biography\Fact\Exception;


use AGmakonts\STL\DateTime\DateTime;

/**
 * Class DateInFutureException
 *
 * @package Famillio\Domain\Person\Biography\Fact\Exception
 */
class DateInFutureException extends DomainException
{
    const MESSAGE_FORMAT = 'Date %s is in the future!';

    /**
     * @param \AGmakonts\STL\DateTime\DateTime $date
     */
    public function __construct(DateTime $date)
    {
        $this->message = sprintf(self::MESSAGE_FORMAT, $date->value());
    }
}