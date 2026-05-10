<?php

namespace App\Models;

use Spatie\MediaLibrary\Support\PathGenerator\PathGeneratorFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\MediaLibrary\ProjectPathGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Enums\Fit;

#[Fillable(['name', 'category_id', 'description', 'project_number', 'url_youtube'])]
class Project extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;

  protected $casts = [
    'name' => 'array',
    'description' => 'array',
  ];

  protected static function booting(): void
  {
    PathGeneratorFactory::setCustomPathGenerators(
      static::class,
      ProjectPathGenerator::class
    );
  }

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('projects');

    $this->addMediaCollection('vr_images');
  }

  public function registerMediaConversions(?Media $media = null): void
  {
    $this->addMediaConversion('default')
      ->fit(Fit::Max, 1000, 1000)
      ->quality(70)
      ->format('webp')
      ->nonQueued();
  }

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
}
