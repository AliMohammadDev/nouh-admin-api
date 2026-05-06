<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\CreateTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\services\TagService;

class TagController extends Controller
{
  public function __construct(
    private TagService $tagService
  ) {}

  public function index()
  {
    $tags = $this->tagService->findAll();
    return TagResource::collection($tags);
  }

  public function store(CreateTagRequest $request)
  {
    $tag = $this->tagService->createTag($request->validated());
    return new TagResource($tag);
  }

  public function show(Tag $tag)
  {
    return new TagResource($this->tagService->findOne($tag));
  }

  public function update(UpdateTagRequest $request, Tag $tag)
  {
    $updatedTag = $this->tagService->updateTag($tag, $request->validated());
    return new TagResource($updatedTag);
  }


  public function destroy(Tag $tag)
  {
    $this->tagService->deleteTag($tag);
    return response()->json(['message' => 'Tag deleted successfully']);
  }
}
