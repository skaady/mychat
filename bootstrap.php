<?php

use \myApp;

/* autoload classes */
spl_autoload_register('myAutoloader');

function myAutoloader($sClassName) {
    $sClassExtension = '.php';

    $aClassFolders = array(
        './app/controllers/',
        './app/views/',
        './core/'
    );

    foreach ($aClassFolders as $sPath) {
        $sFile = $sPath . $sClassName . $sClassExtension;

        if (file_exists($sFile)) {
            require_once $sFile;
            return true;
        } else {
            $aParts = explode('\\', $sClassName);
            $sFile = $sPath . end($aParts) . $sClassExtension;
            if (file_exists($sFile)) {
                require_once $sFile;
                return true;
            }
        }
    }

    return false;
}

/* configure active record lib */
$oConf = Conf::getInstance();

require_once 'core/ActiveRecord/ActiveRecord.php';

ActiveRecord\Config::initialize(function($cfg) use ($oConf) {
    $cfg->set_model_directory('./app/models');
    $cfg->set_connections($oConf->getConfParam('aConnections'));
    $cfg->set_default_connection($oConf->getConfParam('sDefConn'));
});

