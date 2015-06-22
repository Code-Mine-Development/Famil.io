<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 17:25
 */

namespace Famillio\Domain\Person\ValueObject\Biography\Fact;


use AGmakonts\STL\AbstractValueObject;
use AGmakonts\STL\DateTime\DateTime;
use AGmakonts\STL\Number\Integer;
use AGmakonts\STL\String\Text;
use Rhumsaa\Uuid\Uuid;

/**
 * Class Identifier
 *
 * @package Famillio\Domain\Person\ValueObject\Biography\Fact
 */
class Identifier extends AbstractValueObject
{
    const DELIMITER = '@';
    const FORMAT    = '%s' . self::DELIMITER . '%\'.012d';

    /**
     * @var \AGmakonts\STL\String\Text
     */
    private $identifier;

    /**
     * @var \AGmakonts\STL\DateTime\DateTime
     */
    private $date;

    /**
     * @param \AGmakonts\STL\String\Text $identifier
     *
     * @return \Famillio\Domain\Person\ValueObject\Biography\Fact\Identifier
     */
    static public function get(Text $identifier) : Identifier
    {
        return self::getInstanceForValue([$identifier]);
    }

    /**
     * @param \AGmakonts\STL\DateTime\DateTime $dateTime
     *
     * @return \Famillio\Domain\Person\ValueObject\Biography\Fact\Identifier
     */
    static public function generate(DateTime $dateTime) : Identifier
    {
        $textObject = self::formatIdentifier(Uuid::uuid4(), $dateTime);

        return self::get($textObject);
    }

    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function identifier() : Text
    {
        return $this->identifier;
    }

    /**
     * @return \AGmakonts\STL\DateTime\DateTime
     */
    public function date() : DateTime
    {
        return $this->date;
    }

    /**
     * @param \AGmakonts\STL\DateTime\DateTime $dateTime
     *
     * @return \Famillio\Domain\Person\ValueObject\Biography\Fact\Identifier
     */
    public function atChangedDate(DateTime $dateTime) : Identifier
    {
        $valueParts    = $this->extractParts($this->identifier());
        $uuid          = Uuid::fromString($valueParts['uuid']);
        $newIdentifier = self::formatIdentifier($uuid, $dateTime);

        return self::get($newIdentifier);
    }

    /**
     * @param array $value
     *
     */
    protected function __construct(array $value)
    {
        $value = $value[0];

        $valueParts = $this->extractParts($value);

        $dateTime = DateTime::get(Integer::get($valueParts['timestamp']));

        if (FALSE === Uuid::isValid($valueParts['uuid'])) {

        }

        $this->identifier = $value;
        $this->date       = $dateTime;

    }

    /**
     * @param \AGmakonts\STL\String\Text $identifier
     *
     * @return array
     */
    private function extractParts(Text $identifier) : array
    {
        $value = $identifier->value();

        $valueParts = explode(self::DELIMITER, $value);

        $timestamp  = (int)$valueParts[0];
        $scalarUuid = $valueParts[1];

        return [
            'timestamp' => $timestamp,
            'uuid'      => $scalarUuid,
        ];
    }

    /**
     * @param \Rhumsaa\Uuid\Uuid               $uuid
     * @param \AGmakonts\STL\DateTime\DateTime $dateTime
     *
     * @return \AGmakonts\STL\String\Text
     */
    static private function formatIdentifier(Uuid $uuid, DateTime $dateTime) : Text
    {
        $timestamp  = $dateTime->getTimestamp()->value();
        $formatted  = sprintf(self::FORMAT, $uuid->toString(), $timestamp);
        $textObject = Text::get($formatted);

        return $textObject;
    }

    /**
     * @return string
     */
    public function value() : string
    {
        return $this->identifier()->value();
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->value();
    }

    /**
     * @return string
     */
    public function extractedValue() : string
    {
        return self::extractValue([$this->identifier]);
    }

}