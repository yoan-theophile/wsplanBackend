<?php

namespace App\System;

require_once 'rb-mysql.php';

// This class holds our database connection and adds the initialization of the connection 
// to our bootstrap.php file


class DatabaseConnector
{
    public static function setup()
    {
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $db = $_ENV['DB_DATABASE'];
        $user = $_ENV['DB_USERNAME'];
        $pass = $_ENV['DB_PASSWORD'];

        try {
            return \R::setup("mysql:host=$host;port=$port;charset=utf8mb4;dbname=$db", $user,  $pass);
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }
}
