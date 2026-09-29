<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\CrateContactRequest;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
  public function __construct(
    private ContactService $contactService
  ) {}

  public function sendContact(CrateContactRequest $request): JsonResponse
  {
    $this->contactService->store($request->validated());

    return response()->json(true, 201);
  }
}
