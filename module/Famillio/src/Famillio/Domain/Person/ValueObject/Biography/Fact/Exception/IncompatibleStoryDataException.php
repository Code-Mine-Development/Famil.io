<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 13/06/15
 * Time: 12:43
 */

namespace Famillio\Domain\Person\ValueObject\Biography\Fact\Exception;

/**
 * Class IncompatibleStoryDataException
 *
 * @package Famillio\Domain\Person\ValueObject\Biography\Fact\Exception
 */
class IncompatibleStoryDataException extends InvalidArgumentException
{
    const MESSAGE_FORMAT = 'Provided string use one or more tokens that are not present in provided data. Missing tokens: %s';

    /**
     * @param array $differences
     */
    public function __construct(array $differences)
    {
        $this->message = sprintf(self::MESSAGE_FORMAT, implode(', ', $differences));
    }

}