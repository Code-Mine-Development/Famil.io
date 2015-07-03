<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 21:54
 */

namespace Famillio\Model\Person\ValueObject\Name\Exception;


use AGmakonts\STL\String\String;

/**
 * Class InvalidNameException
 *
 * @package Famillio\Model\Person\ValueObject\Name\Exception
 */
class InvalidNameException extends \DomainException
{
    const MESSAGE_FORMAT_KNOWN_REASONS = 'Provided name (\'%s\') is invalid because of following reasons: %s';
    const MESSAGE_FORMAT_UNKNOWN_REASON = 'Provided name (\'%s\') is invalid. Exact reason is unknown';

    /**
     * @param \AGmakonts\STL\String\String $name
     * @param array                        $reasons
     */
    public function __construct(String $name, array $reasons)
    {

        if(FALSE === empty($reasons)) {
            $this->message = sprintf(
                self::MESSAGE_FORMAT_KNOWN_REASONS,
                $name->value(),
                implode(', ', $this->parseReasons($reasons)));

        } else {
            $this->message = sprintf(self::MESSAGE_FORMAT_UNKNOWN_REASON, $name->value());
        }
    }

    /**
     * @param array $reasons
     *
     * @return array
     */
    private function parseReasons(array $reasons) : array
    {
        $reasonsFlattened = [];

        foreach($reasons as $key => $reason) {
            if(TRUE === is_array($reasons)) {
                $reasonsFlattened[] = $this->parseReasons($reason);
            } else {
                return $reason;
            }
        }

        return $reasonsFlattened;
    }
}