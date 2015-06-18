<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 18/06/15
 * Time: 16:59
 */

namespace Famillio\Domain\Family\Collection;

/**
 * Class BiographyTest
 *
 * @package Famillio\Domain\Family\Collection
 */
class BiographyTest extends \PHPUnit_Framework_TestCase
{
    public function testOrder()
    {
        $a = new \SplPriorityQueue();
        $a->setExtractFlags(\SplPriorityQueue::EXTR_BOTH);




        $a->insert(new \DateTime(), time());
        $a->insert('4', 4);
        $a->insert('4a', 42525252525);
        $a->insert('2', 2);
        $a->insert('4535355', 34344);
        $a->insert('3434', 454);


        foreach($a as $b => $s){
            var_dump($b, $s);
        }

    }
}
