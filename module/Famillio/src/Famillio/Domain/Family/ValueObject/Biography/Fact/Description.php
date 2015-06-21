<?php
/**
 * Date:   11/06/15
 * Time:   15:05
 * 
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact;


use AGmakonts\STL\AbstractValueObject;
use AGmakonts\STL\String\Text;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Exception\InvalidDescriptionException;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;

/**
 * Class Description
 *
 * @package Famillio\Domain\Famillio\ValueObject\Biography\Fact
 */
class Description extends AbstractValueObject
{
    const MINIMUM_LENGTH = 10;
    const MAXIMUM_LENGTH = 1000000;

    private $description;


    /**
     * @param \AGmakonts\STL\String\Text $contents
     *
     * @return mixed
     */
    static public function get(Text $contents) : Description
    {
        return self::getInstanceForValue([$contents]);
    }

    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function contents() : Text
    {
        return $this->description;
    }

    /**
     * @param \AGmakonts\STL\String\Text $content
     *
     * @return bool
     */
    private function isContentValid(Text $content)
    {
        $rawContent = $content->value();

        $validatorChain = new ValidatorChain();

        $validatorChain->attach(new StringLength([
            'min' => self::MINIMUM_LENGTH,
            'max' => self::MAXIMUM_LENGTH
                                                 ]));

        return $validatorChain->isValid($rawContent);
    }

    /**
     * @param array $value
     *
     */
    protected function __construct(array $value)
    {
        /** @var \AGmakonts\STL\String\Text $contents */
        $contents = $value[0];


        if(TRUE === ctype_space($contents->value()) ||
           TRUE === $contents->length()->isZero()) {

            throw new InvalidDescriptionException();
        }
    }

    /**
     * @return string
     */
    public function value()
    {
        return $this->contents()->value();
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
        return self::extractValue([$this->description]);
    }
}