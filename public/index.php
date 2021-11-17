<?php

use Alex\Config\Router;
use Symfony\Component\Dotenv\Dotenv;

require '../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->loadEnv('../.env');

session_start();

$router = new Router();
$router->run();
