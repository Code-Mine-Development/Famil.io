<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 13:16
 */

namespace Famillio\Domain\Person\Collection\Biography\DataExtractor\Name;

use Famillio\Domain\Person\Biography\Fact\FactInterface;
use Famillio\Domain\Person\Biography\Fact\GivenNameChangeFactInterface;

/**
 * Class GivenName
 *
 * @package Famillio\Domain\Person\Collection\Biography\DataExtractor\Name
 */
class GivenName extends FamilyName
{
    /**
     * @param \Famillio\Domain\Person\Biography\Fact\FactInterface $factInterface
     */
    public function registerFact(FactInterface $factInterface)
    {
        if($factInterface instanceof GivenNameChangeFactInterface) {
            $this->setName($factInterface->givenName());
        }
    }
}