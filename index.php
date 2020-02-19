<?php

require __DIR__ . '/vendor/autoload.php';

use App\Api\Factories\SupermetricsClientFactory;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

SupermetricsClientFactory::getClient('https://api.supermetrics.com/assignment/');
echo 'Hello world';