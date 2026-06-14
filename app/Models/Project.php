<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'category_id', 'description', 'project_number', 'is_featured', 'country', 'likes_count'])]
class Project extends Model
{
  use HasFactory;
  protected $casts = [
    'name' => 'array',
    'description' => 'array',
    'is_featured' => 'boolean',
    'country' => 'array',
  ];
  public function getTranslatedNameAttribute(): string
  {
    return $this->name[app()->getLocale()]
      ?? $this->name['en']
      ?? '';
  }

  public function getTranslatedDescriptionAttribute(): string
  {
    return $this->description[app()->getLocale()]
      ?? $this->description['en']
      ?? '';
  }

  public function getTranslatedCountryAttribute(): string
  {
    return $this->country[app()->getLocale()]
      ?? $this->country['en']
      ?? '';
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function tags(): BelongsToMany
  {
    return $this->belongsToMany(Tag::class)->withTimestamps();
  }
  public function projectLinks(): HasMany
  {
    return $this->hasMany(ProjectLink::class);
  }

  public function linkTypes(): BelongsToMany
  {
    return $this->belongsToMany(LinkType::class, 'link_type_project')
      ->withPivot('url')
      ->withTimestamps();
  }

  public function galleries(): HasMany
  {
    return $this->hasMany(ProjectGallery::class);
  }
}
