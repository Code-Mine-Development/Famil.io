<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 16/06/15
 * Time: 22:59
 */

namespace Famillio\Domain\Person\Biography\Fact\Exception;

use Famillio\Domain\Person\Biography\Fact\FactInterface;

/**
 * Class DateNotSetYetException
 *
 * @package Famillio\Domain\Person\Biography\Fact\Exception
 */
class DateNotSetYetException extends AbstractFactException
{
    const MESSAGE_FORMAT = 'Fact identified by %s has no date specified yet';

    /**
     * @param \Famillio\Domain\Person\Biography\Fact\FactInterface $fact
     */
    public function __construct(FactInterface $fact)
    {
        parent::__construct($fact);

        $this->message = sprintf(self::MESSAGE_FORMAT, $this->fact()->identity()->value());
    }

}