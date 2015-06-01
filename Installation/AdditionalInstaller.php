<?php

namespace UJM\ExoBundle\Installation;

use Claroline\InstallationBundle\Additional\AdditionalInstaller as BaseInstaller;

class AdditionalInstaller extends BaseInstaller
{
    public function preUpdate($currentVersion, $targetVersion)
    {
//        if (version_compare($currentVersion, '6.0.0', '<') )
//        {
            $updater = new Updater\Updater050000($this->container);
            $updater->setLogger($this->logger);
            $updater->preUpdate($currentVersion);
        //}
    }
    
}