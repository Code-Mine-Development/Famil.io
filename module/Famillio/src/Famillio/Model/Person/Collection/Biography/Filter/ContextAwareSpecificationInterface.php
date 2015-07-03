<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 19/06/15
 * Time: 18:22
 */

namespace Famillio\Model\Person\Collection\Biography\Filter;

use Famillio\Model\Person\Collection\BiographyInterface;

/**
 * Interface ContextAwareSpecificationInterface
 *
 * @package Famillio\Model\Person\Collection\Biography\Filter
 */
interface ContextAwareSpecificationInterface
{
    /**
     * Allows to specify collection instance that will be used as a context in witch
     * determination of specification satisfaction is made.
     *
     * @param \Famillio\Model\Person\Collection\BiographyInterface $biographyInterface
     *
     * @return void
     */
    public function registerContext(BiographyInterface $biographyInterface);
}