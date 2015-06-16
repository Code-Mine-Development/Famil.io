<?php
/**
 * Date:   11/06/15
 * Time:   15:03
 *
 */

namespace Famillio\Domain\Family\Biography\Fact\LifeEvent;


use AGmakonts\STL\String\Text;
use AGmakonts\STL\Structure\KeyValuePair;
use Famillio\Domain\Family\Biography\Fact\AbstractFact;
use Famillio\Domain\Family\Biography\Fact\FamilyNameChangeFactInterface;
use Famillio\Domain\Family\Biography\Fact\GenderChangeFactInterface;
use Famillio\Domain\Family\Biography\Fact\GivenNameChangeFactInterface;
use Famillio\Domain\Family\Biography\Fact\LifespanBoundaryFactInterface;
use Famillio\Domain\Family\ValueObject\Biography\Fact\LifespanBoundaryType;
use Famillio\Domain\Family\ValueObject\Biography\Fact\Story;
use Famillio\Domain\Family\ValueObject\Gender;
use Famillio\Domain\Family\ValueObject\Name\FamilyName;
use Famillio\Domain\Family\ValueObject\Name\GivenName;

/**
 * Class Birth
 *
 * @package Famillio\Domain\Family\ValueObject\Biography\Fact\LifeEvent
 */
class Birth extends AbstractFact implements LifespanBoundaryFactInterface,
    GivenNameChangeFactInterface,
    FamilyNameChangeFactInterface,
    GenderChangeFactInterface
{
    private $place;

    private $givenName;

    private $familyName;

    private $gender;

    /**
     * @return \AGmakonts\STL\String\Text
     */
    public function type() : Text
    {
        return Text::get('Birth');
    }

    /**
     * @return FamilyName
     */
    public function familyName() : FamilyName
    {
        return $this->familyName;
    }

    /**
     * @return GivenName
     */
    public function givenName() : GivenName
    {
        return $this->givenName;
    }

    /**
     * @return Gender
     */
    public function gender() : Gender
    {
        return $this->gender;
    }

    public function place() : Text
    {
        return $this->place;
    }


    /**
     * @return LifespanBoundaryType
     */
    public function lifespanBoundaryType() : LifespanBoundaryType
    {
        return LifespanBoundaryType::get(LifespanBoundaryType::BEGINNING);
    }

    /**
     * @return \Famillio\Domain\Family\ValueObject\Biography\Fact\Story
     */
    public function story() : Story
    {
        $past    = Text::get('was born at {DATE} in {LOCATION} ({PLACE})');
        $present = Text::get('is borning in {LOCATION} ({PLACE})');
        $future  = Text::get('will be born ar {DATE} in {LOCATION} ({PLACE})');

        $data = [
            KeyValuePair::get(Text::get('{DATE}'), $this->date()),
            KeyValuePair::get(Text::get('{LOCATION}'), $this->location()),
            KeyValuePair::get(Text::get('{PLACE}'), $this->place()),
        ];

        return Story::get($past, $present, $future, $data);
    }


}