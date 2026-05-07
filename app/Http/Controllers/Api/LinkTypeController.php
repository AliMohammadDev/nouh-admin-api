<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkType\CreateLinkTypeRequest;
use App\Http\Requests\LinkType\UpdateLinkTypeRequest;
use App\Http\Resources\LinkTypeResource;
use App\Models\LinkType;
use App\services\LinkTypeService;
use Illuminate\Http\Request;

class LinkTypeController extends Controller
{

  public function __construct(
    private LinkTypeService $linkTypeService
  ) {}


  public function index()
  {
    return LinkTypeResource::collection($this->linkTypeService->findAll());
  }

  public function store(CreateLinkTypeRequest $request)
  {
    $LinkType = $this->linkTypeService->createLinkType($request->validated());
    return new LinkTypeResource($LinkType);
  }

  public function show(LinkType $LinkType)
  {
    return new LinkTypeResource($this->linkTypeService->findOne($LinkType));
  }

  public function update(UpdateLinkTypeRequest $request, LinkType $LinkType)
  {
    $this->linkTypeService->updateLinkType($LinkType, $request->validated());
    return new LinkTypeResource($LinkType);
  }

  public function destroy(LinkType $LinkType)
  {
    $this->linkTypeService->deleteLinkType($LinkType);
    return response()->json(['message' => 'LinkType deleted successfully']);
  }
}
