<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserImageResource;
use App\Services\UserService;

class UserController extends Controller
{
  public function __construct(
    private UserService $userService
  ) {}

  public function userImages()
  {
    return UserImageResource::collection($this->userService->findUserImages());
  }
}
