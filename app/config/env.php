<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('../');

$dotenv->load();

define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
