<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 22:13
 */

namespace Famillio\Domain\Family\ValueObject\Name;

use AGmakonts\STL\String\Text;
use Famillio\Domain\Family\ValueObject\Name\Exception\InvalidAdditionalGivenNameException;

/**
 * Class GivenName
 *
 * @package Famillio\Domain\Famillio\ValueObject\Name
 */
class GivenName extends AbstractCompoundName
{
    private $first;

    private $additional;

    /**
     * @param \Famillio\Domain\Family\ValueObject\Name\Name $first
     * @param array|NULL                                    $additional
     *
     * @return mixed
     */
    static public function get(Name $first, array $additional = NULL) : GivenName
    {
        return self::getInstanceForValue([
                                             $first,
                                             $additional,
                                         ]);
    }

    /**
     * @param array $value
     *
     */
    protected function __construct(array $value)
    {
        /** @var Name $first */
        /** @var array<Name> $additional */
        list($first, $additional) = $value;

        $this->additional = $this->handleAdditionalNames($additional);
        $this->first = $first;

    }

    /**
     * @param array $names
     *
     * @return array
     */
    private function handleAdditionalNames(array $names)
    {
        if (FALSE === is_array($names) || $names === NULL) {
            return [];
        }

        if(FALSE === $this->isNameArrayValid($names)) {
            throw new InvalidAdditionalGivenNameException();
        }

        return $names;
    }

    /**
     * @return \Famillio\Domain\Family\ValueObject\Name\Name
     */
    public function first() : Name
    {
        return $this->first;
    }

    /**
     * @return array
     */
    public function additional() : array
    {
        return $this->additional;
    }

    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function name() : Text
    {
        $fullGivenName = $this->first()->name();

        /** @var Name $additional */
        foreach ($this->additional() as $additional) {
            $fullGivenName = $fullGivenName->concat(' ')->concat($additional->name());
        }

        return $fullGivenName;
    }

    /**
     * @param \Famillio\Domain\Family\ValueObject\Name\Name $name
     *
     * @return GivenName
     */
    public function changedFirst(Name $name) : GivenName
    {
        return self::get($name, $this->additional());
    }

    /**
     * @param array $names
     *
     * @return GivenName
     */
    public function changedAdditional(array $names) : GivenName
    {
        return self::get($this->first(), $names);
    }

    /**
     * @param $name
     *
     * @return GivenName
     */
    public function appendedAdditional(Name $name) : GivenName
    {
        $additional   = $this->additional();
        $additional[] = $name;

        return self::get($this->first(), $additional);
    }

    /**
     * @param \Famillio\Domain\Family\ValueObject\Name\Name $name
     *
     * @return GivenName
     */
    public function prependedAdditional(Name $name) : GivenName
    {
        $additional = $this->additional();
        array_unshift($additional, $name);

        return self::get($this->first(), $additional);

    }


    /**
     * @return mixed
     */
    public function value()
    {
        return $this->name()->value();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value();
    }

    /**
     * @return string
     */
    public function extractedValue()
    {
        return self::extractValue([
                                      $this->first,
                                      $this->additional,
                                  ]);
    }

}