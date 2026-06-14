<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'type'])]
class ProjectSection extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',
    'type',
  ];
  protected $casts = [
    'name' => 'array',
  ];
  public function getTranslatedNameAttribute(): string
  {
    return $this->name[app()->getLocale()]
      ?? $this->name['en']
      ?? '';
  }

  public function galleries()
  {
    return $this->hasMany(ProjectGallery::class);
  }
}
