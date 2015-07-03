<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 16/06/15
 * Time: 22:39
 */

namespace Famillio\Model\Person\Collection\Exception;

use Famillio\Model\Person\Biography\Fact\FactInterface;

/**
 * Class DuplicatedFactAdditionAttemptException
 *
 * @package Famillio\Model\Person\Collection\Exception
 */
class DuplicatedFactAdditionAttemptException extends InvalidArgumentException
{
    const MESSAGE_FORMAT = '%s fact, identified by %s is already present in collection';

    /**
     * DuplicatedFactAdditionAttemptException constructor.
     *
     * @param \Famillio\Model\Person\Biography\Fact\FactInterface $fact
     */
    public function __construct(FactInterface $fact)
    {
        $this->message = sprintf(self::MESSAGE_FORMAT, $fact->type()->value(), $fact->identity()->value());
    }
}