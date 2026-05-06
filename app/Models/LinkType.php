<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name'])]
class LinkType extends Model
{
  use HasFactory;
  protected $casts = [
    'name' => 'array',
  ];

  public function getTranslatedNameAttribute(): string
  {
    return $this->name[app()->getLocale()]
      ?? $this->name['en']
      ?? '';
  }
  public function projects(): BelongsToMany
  {
    return $this->belongsToMany(Project::class)
      ->withPivot('url')
      ->withTimestamps();
  }
}
