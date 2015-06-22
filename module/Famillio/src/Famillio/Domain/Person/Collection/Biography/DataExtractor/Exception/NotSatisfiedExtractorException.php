<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 11:39
 */

namespace Famillio\Domain\Person\Collection\Biography\DataExtractor\Exception;

/**
 * Class NotSatisfiedExtractorException
 *
 * @package Famillio\Domain\Person\Collection\Biography\DataExtractor\Exception
 */
class NotSatisfiedExtractorException extends RuntimeException
{
    const MESSAGE_FORMAT = 'Cannot get date from unsatisfied extractor';

    /**
     * NotSatisfiedExtractorException constructor.
     */
    public function __construct()
    {
        $this->message = self::MESSAGE_FORMAT;
    }


}