<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 16/06/15
 * Time: 22:54
 */

namespace Famillio\Domain\Family\Biography\Fact\Exception;

use AGmakonts\STL\DateTime\DateTime;
use Famillio\Domain\Family\Biography\Fact\AbstractFact;

/**
 * Class DateAlreadySetException
 *
 * @package Famillio\Domain\Family\Biography\Fact\Exception
 */
class DateAlreadySetException extends AbstractFactException
{
    const MESSAGE_FORMAT = 'Fact identified by %s has date already set. Reconstruct the Fact to change date';

    /**
     * @param \Famillio\Domain\Family\Biography\Fact\AbstractFact $fact
     * @param \DateTime                                           $date
     */
    public function __construct(AbstractFact $fact, DateTime $date)
    {
        parent::__construct($fact);

        $this->message = sprintf(self::MESSAGE_FORMAT, $this->fact()->identity()->value());
    }

}