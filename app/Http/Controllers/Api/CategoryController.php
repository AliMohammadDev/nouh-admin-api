<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function __construct(
    private CategoryService $categoryService
  ) {}


  public function index()
  {
    return CategoryResource::collection($this->categoryService->findAll());
  }

  public function store(CreateCategoryRequest $request)
  {
    $category = $this->categoryService->createCategory($request->validated());
    return new CategoryResource($category);
  }

  public function show(Category $category)
  {
    return new CategoryResource($this->categoryService->findOne($category));
  }

  public function update(UpdateCategoryRequest $request, Category $category)
  {
    $this->categoryService->updateCategory($category, $request->validated());
    return new CategoryResource($category);
  }

  public function destroy(Category $category)
  {
    $this->categoryService->deleteCategory($category);
    return response()->json(['message' => 'Category deleted successfully']);
  }
}
