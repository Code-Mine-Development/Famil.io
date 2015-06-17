<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 17/06/15
 * Time: 18:37
 */

namespace Application\Check\Dependencies;


use ZendDiagnostics\Check\AbstractCheck;
use ZendDiagnostics\Result\ResultInterface;

/**
 * Class IsComposerSetupForStrictVersions
 *
 * @package Application\Check\Dependencies
 */
class IsComposerSetupForStrictVersions extends AbstractCheck
{
    /**
     * Perform the actual check and return a ResultInterface
     *
     * @return ResultInterface
     */
    public function check()
    {
        $composerJson = file_get_contents(APPLICATION_PATH . '/composer.json');

        $json = json_decode($composerJson);

        foreach($json->require as $dependency => $version)
        {
            $lowercaseVersion = strtolower($version);
            if($lowercaseVersion === 'dev-master' ||
                $lowercaseVersion === 'dev-develop' ||
                $lowercaseVersion === '*') {
                return FALSE;
            }
        }

        return TRUE;
    }

}