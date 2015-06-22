<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 17/06/15
 * Time: 23:28
 */

namespace Famillio\Domain\Person\ValueObject\Biography\Fact;

use AGmakonts\STL\DateTime\DateTime;
use AGmakonts\STL\Number\Integer;

/**
 * Class IdentifierTest
 *
 * @package Famillio\Domain\Person\ValueObject\Biography\Fact
 * @coversDefaultClass \Famillio\Domain\Person\ValueObject\Biography\Fact\Identifier
 */
class IdentifierTest extends \PHPUnit_Framework_TestCase
{

    public function testIdGeneration()
    {

        Identifier::generate(DateTime::get());

    }
}
