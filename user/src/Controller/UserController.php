<?php

namespace App\Controller;

use App\System\ApiResponse;

class UserController
{
    private $requestMethod;
    private $userId;
    private $tableName;

    public function __construct($requestMethod, $service, $userId)
    {
        $this->requestMethod = $requestMethod;
        $this->userId = $userId;
        $this->tableName = $service === "student" ? "student" : "manager";
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->userId) {
                    $this->getById($this->userId);
                } else {
                    $this->getAll();
                }
                break;

            case 'POST':
                $this->createFromRequest();
                break;

            case 'PATCH':
                $this->updateFromRequest($this->userId);
                break;

            default:
                $this->notFoundResponse();
                break;
        }
    }

    private function getAll()
    {
        $result = \R::find($this->tableName);
        ApiResponse::respond(200, $result);
    }

    private function getById($id)
    {
        $result = \R::load($this->tableName, $id);
        ApiResponse::respond(200, $result);
    }

    private function validatePerson($input)
    {
        if (!isset(
            $input['email'],
            $input['password'],
            $input['firstname'],
            $input['lastname'],
            $input['sex']
        )) {
            return false;
        }
        return true;
    }

    private function createFromRequest()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validatePerson($input)) {
            $this->unprocessableEntityResponse();
            return;
        }
        $user = \R::dispense($this->tableName);
        $user->email = $input['email'];
        $user->password = $input['password'];
        $user->firstname = $input['firstname'];
        $user->lastname = $input['lastname'];
        $user->sex = $input['sex'];

        if (isset($input['class'])) {
            $user->class = $input['class'];
        }
        $user->active = 1;
        $user->lastlog = date("Y-m-d");

        \R::store($user);

        return ApiResponse::respond(201, $user);
    }

    private function updateFromRequest($id)
    {
        $user = \R::load($this->tableName, $id);
        if (! $user) {
            return $this->notFoundResponse();
        }
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (isset($input['email'])) {
            $user->email = $input['email'];
        }

        if (isset($input['password'])) {
            $user->password = $input['password'];
        }

        if (isset($input['firstname'])) {
            $user->firstname = $input['firstname'];
        }

        if (isset($input['lastname'])) {
            $user->lastname = $input['lastname'];
        }

        if (isset($input['sex'])) {
            $user->sex = $input['sex'];
        }

        if (isset($input['class'])) {
            $user->class = $input['class'];
        }

        if (isset($input['active'])) {
            $user->active = $input['active'];
        }

        if (isset($input['lastlog'])) {
            $user->lastlog = $input['lastlog'];
        }

        \R::store($user);
        return ApiResponse::respond(200, $user);
    }

    private function notFoundResponse()
    {
        ApiResponse::respond(404, null);
    }

    private function unprocessableEntityResponse()
    {
        ApiResponse::respond(422, [
            'error' => 'Invalid input'
        ]);
    }
}
