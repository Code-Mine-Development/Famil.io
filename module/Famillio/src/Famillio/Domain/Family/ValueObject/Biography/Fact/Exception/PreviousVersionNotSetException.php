<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 15/06/15
 * Time: 15:02
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact\Exception;


use Famillio\Domain\Family\ValueObject\Biography\Fact\Story;

class PreviousVersionNotSetException extends BadMethodCallException
{
    const MESSAGE_FORMAT = 'Story \'%s\' doesn\'t have previous version';

    /**
     * PreviousVersionNotSetException constructor.
     *
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Story $story
     */
    public function __construct(Story $story)
    {
        $this->message = sprintf(self::MESSAGE_FORMAT, $story->value());
    }
}