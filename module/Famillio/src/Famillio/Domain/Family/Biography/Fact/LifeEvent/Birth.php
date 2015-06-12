<?php
/**
 * Date:   11/06/15
 * Time:   15:03
 *
 */

namespace Famillio\Domain\Family\Biography\Fact\LifeEvent;


use AGmakonts\STL\String\String;
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
 * @package Famillio\Domain\Famillio\ValueObject\Biography\Fact\LifeEvent
 */
class Birth extends AbstractFact implements LifespanBoundaryFactInterface,
    GivenNameChangeFactInterface,
    FamilyNameChangeFactInterface,
    GenderChangeFactInterface
{
    private $place;

    private $time;

    private $givenName;

    private $familyName;

    private $gender;

    /**
     * @return \AGmakonts\STL\String\String
     */
    public function type() : String
    {
        return String::get('Birth');
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


    /**
     * @return LifespanBoundaryType
     */
    public function lifespanBoundaryType() : LifespanBoundaryType
    {
        return LifespanBoundaryType::get(LifespanBoundaryType::BEGINNING);
    }

    /**
     * @return mixed
     */
    public function story() : Story
    {

    }


}