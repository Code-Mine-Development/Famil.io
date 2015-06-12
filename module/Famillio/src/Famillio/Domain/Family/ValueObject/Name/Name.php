<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 11/06/15
 * Time: 18:31
 */

namespace Famillio\Domain\Family\ValueObject\Name;


use AGmakonts\STL\AbstractValueObject;
use AGmakonts\STL\String\String;
use Famillio\Domain\Family\ValueObject\Name\Exception\InvalidNameException;
use Zend\Filter\Callback;
use Zend\Filter\FilterChain;
use Zend\Filter\StringToLower;
use Zend\Filter\StringTrim;
use Zend\Filter\StripNewlines;
use Zend\Filter\StripTags;
use Zend\I18n\Validator\Alpha as AlphaValidator;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;

/**
 * Class Name
 *
 * @package Famillio\Domain\Family\ValueObject\Name
 */
class Name extends AbstractValueObject
{
    const MINIMUM_LENGTH = 2;

    private $name;

    /**
     * @param \AGmakonts\STL\String\String $name
     *
     * @return mixed
     */
    static public function get(String $name) : Name
    {
        return self::getInstanceForValue([self::filterName($name)]);
    }

    /**
     * @param \AGmakonts\STL\String\String $name
     *
     * @return \AGmakonts\STL\String\String
     */
    static private function filterName(String $name) : String
    {
        $nameValue = $name->value();

        $filterChain = new FilterChain();

        $filterChain->attach(new StripNewlines());
        $filterChain->attach(new StripTags());
        $filterChain->attach(new StringTrim());
        $filterChain->attach(new StringToLower());
        $filterChain->attach(new Callback(function($value){
            return ucwords($value);
        }));

        $filteredValue = $filterChain->filter($nameValue);

        return String::get($filteredValue);
    }

    public function name() : String
    {
        return $this->name;
    }

    /**
     * @param array $value
     *
     */
    protected function __construct(array $value)
    {
        /** @var \AGmakonts\STL\String\String $name */
        $name = $value[0];

        $nameValue = $name->value();

        $validatorChain = new ValidatorChain();

        $validatorChain->attach(new AlphaValidator(TRUE));
        $validatorChain->attach(new StringLength(['min' => self::MINIMUM_LENGTH]));
        $validatorChain->attach(new NotEmpty());

        if(FALSE === $validatorChain->isValid($nameValue)) {
            throw new InvalidNameException($name, $validatorChain->getMessages());
        }

        $this->name = $name;

    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->name->value();
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
        return self::extractValue([$this->name]);
    }
}