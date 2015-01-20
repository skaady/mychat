<?php

$aConfData = array(
    /* Path config */
    'sAppRoot'          => $_SERVER['DOCUMENT_ROOT'] . '/app/',
    'sTplRoot'          => $_SERVER['DOCUMENT_ROOT'] . '/out/tpl/',
    'sImgRoot'          => '/out/img/',
    'sSrcRoot'          => '/out/src/',
    /* DB config */
    'aConnections'      => [
        'dev'  => 'mysql://chat:qwe123@localhost/chat',
        'prod' => 'mysql://u921710701_chat:fg3^uJf4@mysql.0hosting.me/u921710701_chat'
    ],
    'sDefConn'          => 'dev',
    /* app config */
    'sAppEnc'           => 'utf-8',
    'iUserLifetime'     => 8 * 60 * 60, //user auth time limit
    'iMessOnPage'       => 50, // number of displaying messages
    'iOldestMessCnt'    => 10, //oldest messages count
    'iOldestMessLength' => 5, //oldest messages max length
    'sUserMarker'       => '@'//user name marker
);

