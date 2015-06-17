<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 17/06/15
 * Time: 13:11
 */

namespace Application\Check\Environment;


use ZendDiagnostics\Check\AbstractCheck;
use ZendDiagnostics\Result\ResultInterface;

/**
 * Class is64bit
 *
 * @package Application\Check\Environment
 */
class Is64bit extends AbstractCheck
{
    /**
     * Perform the actual check and return a ResultInterface
     *
     * @return ResultInterface
     */
    public function check()
    {
        return PHP_INT_SIZE === 8;
    }
}