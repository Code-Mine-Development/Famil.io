<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 20/06/15
 * Time: 13:31
 */

namespace Famillio\Model\Person\Collection\Biography\Filter;
use AGmakonts\STL\Number\Integer;
use Famillio\Model\Person\Biography\Fact\FactInterface;

/**
 * Class Latest
 *
 * Allows to grab X latests facts.
 *
 * @package Famillio\Model\Person\Collection\Biography\Filter
 */
class Latest implements SpecificationInterface
{
    /**
     * @var \AGmakonts\STL\Number\Integer
     */
    private $counter;

    /**
     * Latest constructor.
     *
     * @param \AGmakonts\STL\Number\Integer $count
     */
    public function __construct(Integer $count = NULL)
    {
        if (NULL === $count) {
            $count = Integer::get(1);
        }

        $this->counter = $count;
    }


    /**
     * Check if provided Fact satisfies specification.
     *
     * @param \Famillio\Model\Person\Biography\Fact\FactInterface $factInterface
     *
     * @return bool
     */
    public function isFactAcceptable(FactInterface $factInterface) : bool
    {
        /*
         * If counter not dropped yet to zero decrement the counter and return
         * TRUE. Otherwise return FALSE
         */
        if (FALSE === $this->counter->isZero()) {
            $this->counter = $this->counter->decrement();

            return TRUE;
        }

        return FALSE;

    }

}