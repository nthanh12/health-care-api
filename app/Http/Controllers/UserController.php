<?php

namespace App\Http\Controllers;

use App\Http\Service\UserService;
use Illuminate\Http\Request;

class UserController
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function getUserList(){
        return $this->userService->getAll();
    }
    public function getUser($email){
        return $this->userService->getUser($email);
    }
    public function addUser(Request $request){
        return $this->userService->addUser($request);
    }
}
