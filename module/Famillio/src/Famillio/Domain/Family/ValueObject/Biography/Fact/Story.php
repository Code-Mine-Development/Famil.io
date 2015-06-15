<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 12/06/15
 * Time: 12:49
 */

namespace Famillio\Domain\Family\ValueObject\Biography\Fact;


use AGmakonts\STL\AbstractValueObject;
use AGmakonts\STL\String\Text;
use AGmakonts\STL\Structure\KeyValuePair;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Exception\CorruptedTokensException;
use Famillio\Domain\Family\ValueObject\Gender;
use Zend\Validator\Regex;
use Zend\Validator\ValidatorChain;

/**
 * Class Story
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact
 */
class Story extends AbstractValueObject
{

    /**
     * @var \AGmakonts\STL\String\Text
     */
    private $present;

    /**
     * @var \AGmakonts\STL\String\Text
     */
    private $past;

    /**
     * @var \AGmakonts\STL\String\Text
     */
    private $future;

    /**
     * @var \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
    private $previous;

    /**
     * @var \Famillio\Domain\Family\ValueObject\Gender|
     */
    private $gender;

    /**
     * @var array
     */
    private $data;


    /**
     * @param \AGmakonts\STL\String\Text                                    $past
     * @param \AGmakonts\STL\String\Text                                    $present
     * @param \AGmakonts\STL\String\Text                                    $future
     * @param array                                                         $data
     * @param \Famillio\Domain\Family\ValueObject\Gender|NULL               $genderTarget
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Story|NULL $previous
     *
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
    static public function get(Text $past,
                               Text $present,
                               Text $future,
                               array $data,
                               Gender $genderTarget = NULL,
                               Story $previous = NULL) : Story
    {

        if (NULL !== $previous) {
            $original = self::extractedOriginal($previous);
        } else {
            $original = NULL;
        }

        return self::getInstanceForValue([
                                             $past,
                                             $present,
                                             $future,
                                             $data,
                                             $genderTarget,
                                             $original,
                                         ]);
    }

    /**
     * @param \Famillio\Domain\Family\ValueObject\Biography\Fact\Story $story
     *
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
    static private function extractedOriginal(Story $story) : Story
    {
        if (NULL !== $story->previousVersion()) {
            $original = self::extractedOriginal($story->previousVersion());
        } else {
            $original = $story;
        }

        return $original;

    }


    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function rawPresent() : Text
    {
        return $this->present;
    }

    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function rawPast() : Text
    {
        return $this->past;
    }

    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function rawFuture() : Text
    {
        return $this->future;
    }

    /**
     * @param \Famillio\Domain\Family\ValueObject\Gender $gender
     *
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
    public function genderTargeted(Gender $gender) : Story
    {
        return self::get($this->past(), $this->present(), $this->future(), $gender, $this);
    }

    /**
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
    public function previousVersion() : Story
    {
        return $this->previous;
    }

    /**
     * @param array $value
     *
     */
    protected function __construct(array $value)
    {
        list($past, $present, $future, $data, $gender, $original) = $value;

        if (FALSE === $this->areTokensValid($data)) {
            throw new CorruptedTokensException();
        }

        if (FALSE === $this->areStringsCompatibleWithData($data, $past, $present, $future)) {

        }

        $this->past    = $past;
        $this->present = $present;
        $this->future  = $future;


        $this->gender   = $gender;
        $this->data     = $data;
        $this->previous = $original;
    }

    /**
     * @param array                      $data
     * @param \AGmakonts\STL\String\Text $past
     * @param \AGmakonts\STL\String\Text $present
     * @param \AGmakonts\STL\String\Text $future
     *
     * @return bool
     */
    private function areStringsCompatibleWithData(array $data, Text $past, Text $present, Text $future)
    {
        $tokens = [];

        /** @var \AGmakonts\STL\Structure\KeyValuePair $keyValuePair */
        foreach ($data as $keyValuePair) {
            $tokens[0][] = $keyValuePair->key();
        }

        $stringValidationArray = [
            $past,
            $present,
            $future,
        ];


        foreach ($stringValidationArray as $string) {
            $tokens[] = $this->extractTokens($string);
        }

        $lastCheckedToken = NULL;
        foreach ($tokens as $token) {
            if (NULL === $lastCheckedToken) {
                $lastCheckedToken = $token;
                continue;
            }

            if ($lastCheckedToken !== $token) {
                return FALSE;
            }
        }

        return TRUE;

    }


    private function tokenDiferences(array $tokenLists)
    {

    }


    /**
     * @param \AGmakonts\STL\String\Text $string
     *
     * @return array
     */
    private function extractTokens(Text $string) : array
    {
        $extractedTokens = [];
        preg_match_all('/\{[A-Z]+\}/', $string->value(), $extractedTokens);

        return $extractedTokens;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    private function areTokensValid(array $data)
    {
        $validatorChain = new ValidatorChain();

        $validatorChain->attach(new Regex('/^\{[A-Z]+\}$/'));

        /** @var \AGmakonts\STL\Structure\KeyValuePair $value */
        foreach ($data as $value) {
            if(FALSE === ($value instanceof KeyValuePair)) {
                return FALSE;
            }
            if (FALSE === $validatorChain->isValid($value->key()->value())) {
                return FALSE;
            }
        }

        return TRUE;
    }

    /**
     * @return mixed
     */
    public function value()
    {
    }

    /**
     * @return string
     */
    public function __toString()
    {
    }

    /**
     * @return string
     */
    public function extractedValue()
    {
    }

}