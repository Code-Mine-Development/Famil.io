<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 22:52
 */

namespace Famillio\Domain\Family\Collection\Biography\DataExtractor;

use AGmakonts\STL\ValueObjectInterface;
use Famillio\Domain\Family\Biography\Fact\FactInterface;

/**
 * Interface DataExtractorInterface
 *
 * @package Famillio\Domain\Family\Collection\Biography\DataExtractor
 */
interface DataExtractorInterface
{
    /**
     * @param \Famillio\Domain\Family\Biography\Fact\FactInterface $factInterface
     *
     * @return void
     */
    public function registerFact(FactInterface $factInterface);

    /**
     * @return bool
     */
    public function isSatisfied() : bool;

    /**
     * @return \AGmakonts\STL\ValueObjectInterface
     */
    public function data() : ValueObjectInterface;
}