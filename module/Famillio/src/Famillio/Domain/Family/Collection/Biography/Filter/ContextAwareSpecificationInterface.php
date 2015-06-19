<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 18:22
 */

namespace Famillio\Domain\Family\Collection\Biography\Filter;


use Famillio\Domain\Family\Collection\BiographyInterface;

/**
 * Interface ContextAwareSpecificationInterface
 *
 * @package Famillio\Domain\Family\Collection\Biography\Filter
 */
interface ContextAwareSpecificationInterface
{
    /**
     * Allows to specify collection instance that will be used as a context in witch
     * determination of specification satisfaction is made.
     *
     * @param \Famillio\Domain\Family\Collection\BiographyInterface $biographyInterface
     *
     * @return void
     */
    public function registerContext(BiographyInterface $biographyInterface);
}