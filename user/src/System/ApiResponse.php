<?php

namespace App\System;

class ApiResponse
{
    public static function code($code)
    {
        switch ($code) {
            case 200:
                header("HTTP/1.1 200 OK");
                break;
            case 201:
                header("HTTP/1.1 201 Created");
                break;
            case 400:
                header("HTTP/1.1 Bad Request");
                break;
            case 401:
                header("HTTP/1.1 401 Unauthorized");
                break;
            case 422:
                header("HTTP/1.1 422 Unprocessable Entity");
                break;
            case 404:
                header("HTTP/1.1 404 Not Found");
                break;
            case 500:
                header("HTTP/1.1 500 Internal Server Error");
                break;
            case 501:
                header("HTTP/1.1 501 Not Implemented");
                break;
            case 502:
                header("HTTP/1.1 502 Bad Gateway");
                break;
        }
    }

    public static function respond($code, $body)
    {
        ApiResponse::code($code);
        echo json_encode($body);
    }
}
