<?php

require 'vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dotenv->required(['OKTAAUDIENCE', 'OKTAISSUER', 'SCOPE', 'OKTACLIENTID', 'OKTASECRET']);
$dotenv->required(['DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

// test code, should output:
// api://default
// when you run $ php bootstrap.php
echo $_ENV['OKTAAUDIENCE'];
