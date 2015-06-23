<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 20/06/15
 * Time: 17:01
 */

namespace Famillio\Domain\Person\Collection\Biography\DataExtractor\Exception;

/**
 * Class NotAExtractorInterface
 *
 * @package Famillio\Domain\Person\Collection\Biography\DataExtractor\Exception
 */
class NotAExtractorInterface extends InvalidArgumentException
{
    const MESSAGE_FORMAT = 'Provided element (%s) is not instance of DateExtractorInterface';

    /**
     * NotAExtractorInterface constructor.
     *
     * @param mixed $element
     */
    public function __construct($element)
    {
        $this->message = sprintf(self::MESSAGE_FORMAT, gettype($element));
    }


}