<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 17:33
 */

namespace Famillio\Domain\Family\Biography\Fact\Exception;

use Famillio\Domain\Family\Biography\Fact\FactInterface;

/**
 * Class FactIdentifierAlreadySetException
 *
 * @package Famillio\Domain\Family\Biography\Fact\Exception
 */
class FactIdentifierAlreadySetException extends AbstractFactException
{
    const MESSAGE_FORMAT = 'Fact %s already have identifier set to %s';

    /**
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface $fact
     */
    public function __construct(FactInterface $fact)
    {
        parent::__construct($fact);

        $this->message = sprintf(self::MESSAGE_FORMAT, $fact->type(), $fact->identity()->value());
    }

}