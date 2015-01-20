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
        'prod' => 'mysql://u921710701_chat:fg3^uJf4@localhost/u921710701_chat'
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

