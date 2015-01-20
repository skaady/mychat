<?php

$aConfData = array(
    /* Path config */
    'sRootUrl'          => 'http://loginform.dev:8080/',
    'sAppRoot'          => $_SERVER['DOCUMENT_ROOT'] . '/app/',
    'sTplRoot'          => $_SERVER['DOCUMENT_ROOT'] . '/out/tpl/',
    'sImgRoot'          => '/out/img/',
    'sSrcRoot'          => '/out/src/',
    /* DB config */
    'aConnections'      => [
        'dev'  => 'mysql://chat:qwe123@localhost/chat',
        'prod' => 'mysql://chat:qwe123@localhost/chat'
    ],
    'sDefConn'          => 'dev',
    /* app config */
    'sAppEnc'           => 'utf-8',
    'iUserLifetime'     => 8 * 60 * 60,
    'iMessOnPage'       => 50,
    'iOldestMessCnt'    => 10,
    'iOldestMessLength' => 5,
    'sUserMarker'       => '@'
);

