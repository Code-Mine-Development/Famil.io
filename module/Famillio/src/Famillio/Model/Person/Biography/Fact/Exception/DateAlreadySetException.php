<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 16/06/15
 * Time: 22:54
 */

namespace Famillio\Model\Person\Biography\Fact\Exception;

use AGmakonts\STL\DateTime\DateTime;
use Famillio\Model\Person\Biography\Fact\AbstractFact;

/**
 * Class DateAlreadySetException
 *
 * @package Famillio\Model\Person\Biography\Fact\Exception
 */
class DateAlreadySetException extends AbstractFactException
{
    const MESSAGE_FORMAT = 'Fact identified by %s has date already set. Reconstruct the Fact to change date';

    /**
     * @param \Famillio\Model\Person\Biography\Fact\AbstractFact $fact
     * @param DateTime                                            $date
     */
    public function __construct(AbstractFact $fact, DateTime $date)
    {
        parent::__construct($fact);

        $this->message = sprintf(self::MESSAGE_FORMAT, $this->fact()->identity()->value());
    }

}