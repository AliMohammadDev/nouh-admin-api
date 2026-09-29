<?php


namespace App\Services;

use App\Models\Tag;

class TagService
{
  public function findAll()
  {
    return Tag::all();
  }

  public function createTag(array $data)
  {
    return Tag::create($data);
  }

  public function findOne(Tag $tag)
  {
    return $tag;
  }

  public function updateTag(Tag $tag, array $data)
  {
    $tag->update($data);
    return $tag;
  }

  public function deleteTag(Tag $tag)
  {
    return $tag->delete();
  }
}
