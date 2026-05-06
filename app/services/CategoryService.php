<?php



namespace App\Services;

use App\Models\Category;

class CategoryService
{
  public function findAll()
  {
    return Category::with('major')->get();
  }

  public function createCategory(array $data)
  {
    $category = Category::create($data);
    return $category;
  }

  public function findOne(Category $category)
  {
    return $category->load('major');
  }

  public function updateCategory(Category $category, array $data)
  {
    $category->update($data);
    return $category;
  }

  public function deleteCategory(Category $category)
  {
    return $category->delete();
  }
}
