<?php
$this->_addStyles('style.css');
$this->_addJs('https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js', 1, true);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My chat</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <?= $this->getCssSnippet(); ?>
    </head>
    <body>


