<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 22:55
 */

namespace Famillio\Domain\Family\ValueObject\Name;

use AGmakonts\STL\String\String;
use Famillio\Domain\Family\ValueObject\Name\Exception\EmptyFamilyNameException;
use Famillio\Domain\Family\ValueObject\Name\Exception\InvalidMultipleFamilyNameElementException;

/**
 * Class FamilyName
 *
 * @package Famillio\Domain\Family\ValueObject\Name
 */
class FamilyName extends AbstractCompoundName
{
    const DEFAULT_GLUE = '-';

    private $names;

    private $glue;

    /**
     * @param array                             $names
     * @param \AGmakonts\STL\String\String|NULL $glue
     *
     * @return mixed
     */
    static public function get(array $names, String $glue = NULL) : FamilyName
    {
        return self::getInstanceForValue([$names, $glue]);
    }

    /**
     * @param array $value
     */
    protected function __construct(array $value)
    {
        list($names, $glue) = $value;

        if(TRUE === empty($names)) {
            throw new EmptyFamilyNameException();
        }

        if(FALSE === $this->isNameArrayValid($names)) {
            throw new InvalidMultipleFamilyNameElementException();
        }

        if(NULL === $glue) {
            $glue = String::get(self::DEFAULT_GLUE);
        }

        $this->names = $names;
        $this->glue  = $glue;
    }

    /**
     * @return array
     */
    public function names() : array
    {
        return $this->names;
    }

    /**
     * @return \AGmakonts\STL\String\String
     */
    public function name() : String
    {
        if(1 === count($this->names)) {

            return $this->names()[0]->name();
        } else {

            $scalarNames = [];

            /** @var Name $name */
            foreach($this->names() as $name) {
                $scalarNames[] = $name->name()->value();
            }

            return String::get(implode($this->glue()->value(), $scalarNames));
        }
    }

    /**
     * @return \AGmakonts\STL\String\String
     */
    public function glue() : String
    {
        return $this->glue;
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
        return self::extractValue([$this->names, $this->glue]);
    }

}