<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 12:24
 */

namespace Famillio\Domain\Person\Collection\Biography\DataExtractor\Exception;

/**
 * Class OversatisfiedExtractorException
 *
 * @package Famillio\Domain\Person\Collection\Biography\DataExtractor\Exception
 */
class OversatisfiedExtractorException extends RuntimeException
{
    const MESSAGE_FORMAT = 'Data extractor is over satisfied: %s';

    /**
     * OversatisfiedExtractorException constructor.
     *
     * @param \Famillio\Domain\Person\Collection\Biography\DataExtractor\Exception\string $reason
     */
    public function __construct(string $reason)
    {
        $this->message = sprintf(self::MESSAGE_FORMAT, $reason);
    }


}