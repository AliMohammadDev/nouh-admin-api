<?php

namespace App\Services;

use App\Models\Major;

class MajorService
{
  public function findAll()
  {
    return Major::with('categories')->get();
  }

  public function createMajor(array $data)
  {
    $major = Major::create($data);
    return $major;
  }

  public function findOne(Major $major)
  {
    return $major->load('categories');
  }

  public function updateMajor(Major $major, array $data)
  {
    return $major->update($data);
  }

  public function deleteMajor(Major $major)
  {
    return $major->delete();
  }
}
