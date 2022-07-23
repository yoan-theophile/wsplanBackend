<?php

// This file loads our environment variables adn get the db connection

require 'vendor/autoload.php';

use App\System\DatabaseConnector;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dotenv->required(['OKTAAUDIENCE', 'OKTAISSUER', 'SCOPE', 'OKTACLIENTID', 'OKTASECRET']);
$dotenv->required(['DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

$dbConnection = (new DatabaseConnector())->getConnection();
