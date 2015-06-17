<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 17:25
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact;


use AGmakonts\STL\AbstractValueObject;
use AGmakonts\STL\DateTime\DateTime;
use AGmakonts\STL\String\Text;
use Rhumsaa\Uuid\Uuid;

/**
 * Class Identifier
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact
 */
class Identifier extends AbstractValueObject
{
    const FORMAT = '%s@%\'.012d';


    private $identifier;

    private $date;


    static public function get(Text $identifier) : Identifier
    {

    }

    /**
     * @param \AGmakonts\STL\DateTime\DateTime $dateTime
     */
    static public function generate(DateTime $dateTime) : Identifier
    {
        $timestamp = $dateTime->getTimestamp()->value();

        $uuid = Uuid::uuid4();

        return self::get(Text::get(sprintf(self::FORMAT, $uuid, $timestamp)));
    }

    public function identifier() : Text
    {

    }

    public function date() : DateTime
    {
        return $this->date;
    }

    /**
     * @param \AGmakonts\STL\DateTime\DateTime $dateTime
     */
    public function atChangedDate(DateTime $dateTime) : Identifier
    {

    }

    /**
     * @param array $value
     *
     */
    protected function __construct(array $value)
    {

    }

    /**
     * @return mixed
     */
    public function value()
    {
        // TODO: Implement value() method.
    }

    /**
     * @return string
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
    }

    /**
     * @return string
     */
    public function extractedValue()
    {
        // TODO: Implement extractedValue() method.
    }

}