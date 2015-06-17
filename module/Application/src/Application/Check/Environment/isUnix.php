<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 17/06/15
 * Time: 13:12
 */

namespace Application\Check\Environment;


use ZendDiagnostics\Check\AbstractCheck;
use ZendDiagnostics\Result\ResultInterface;

/**
 * Class isUnix
 *
 * @package Application\Check\Environment
 */
class IsUnix extends AbstractCheck
{
    /**
     * Perform the actual check and return a ResultInterface
     *
     * @return ResultInterface
     */
    public function check()
    {
        return strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN';
    }

}