<?php
// This file is generated by Composer

require_once '../php-github-api/vendor/autoload.php';



$client = new \Github\Client();

$repositories = $client->api('user')->repositories('shashikant-walkunde');
//$repositories = $client->api('user')->repositories('snwalkunde/shashi');
//$repositories = $client->api('snwalkunde')->repositories('shashi');


print_r($repositories);
