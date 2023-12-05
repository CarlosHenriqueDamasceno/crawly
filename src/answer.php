<?php

use Crawly\GetToken;
use Crawly\RequestAnswer;
use GuzzleHttp\Client;

require __DIR__ . '/../vendor/autoload.php';

const BASE_URL = "http://serei.crawly.com.br/";

$client = new Client([
    "base_uri" => BASE_URL,
    "cookies" => true
]);

$getToken = new GetToken($client);
$requestAnswer = new RequestAnswer($client);

$token = $getToken->execute();
echo $requestAnswer->execute($token->prepareToRequest()) . PHP_EOL;
