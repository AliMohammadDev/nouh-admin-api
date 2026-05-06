<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Major\CreateMajorRequest;
use App\Http\Requests\Major\UpdateMajorRequest;
use App\Http\Resources\MajorResource;
use App\Models\Major;
use App\services\MajorService;

class MajorController extends Controller
{
  public function __construct(
    private MajorService $majorService
  ) {}

  public function index()
  {
    return MajorResource::collection($this->majorService->findAll());
  }

  public function store(CreateMajorRequest $request)
  {
    $major = $this->majorService->createMajor($request->validated());
    return new MajorResource($major);
  }

  public function show(Major $major)
  {
    return new MajorResource($this->majorService->findOne($major));
  }

  public function update(UpdateMajorRequest $request, Major $major)
  {
    $this->majorService->updateMajor($major, $request->validated());
    return new MajorResource($major);
  }

  public function destroy(Major $major)
  {
    $this->majorService->deleteMajor($major);
    return response()->json(['message' => 'Major deleted successfully']);
  }
}
