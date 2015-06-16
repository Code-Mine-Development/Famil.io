<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 16/06/15
 * Time: 11:31
 */

namespace Famillio\Domain\Family\Collection;
use AGmakonts\STL\Number\Integer;
use Famillio\Domain\Family\ValueObject\Name\GivenName;
use Famillio\Domain\Family\ValueObject\Name\FamilyName;
use Famillio\Domain\Family\ValueObject\Gender;

/**
 * Interface FactDataAccessInterface
 *
 * @package Famillio\Domain\Family\Collection
 */
interface FactDataAccessInterface
{

    /**
     * @return mixed
     */
    public function currentAge() : Integer;

    /**
     * @return mixed
     */
    public function currentGivenName() : GivenName;

    /**
     * @return mixed
     */
    public function currentFamilyName() : FamilyName;

    /**
     * @return mixed
     */
    public function currentGender() : Gender;

    /**
     * @return mixed
     */
    public function currentResidence() : Address;
}