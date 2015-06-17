<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 17/06/15
 * Time: 18:26
 */

namespace Application\Check\FileSystem;


use ZendDiagnostics\Check\AbstractCheck;
use ZendDiagnostics\Result\ResultInterface;

/**
 * Class IsCacheWritable
 *
 * @package Application\Check\FileSystem
 */
class IsCacheWritable extends AbstractCheck
{
    /**
     * Perform the actual check and return a ResultInterface
     *
     * @return ResultInterface
     */
    public function check()
    {
        return (TRUE === is_writable(APPLICATION_PATH . '/data/cache'));
    }



}