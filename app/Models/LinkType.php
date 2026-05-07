<?php

namespace App\Models;

use App\MediaLibrary\LinkTypePathGenerator;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGeneratorFactory;

#[Fillable(['name'])]
class LinkType extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;
  protected $casts = [
    'name' => 'array',
  ];


  protected static function booting(): void
  {
    PathGeneratorFactory::setCustomPathGenerators(
      static::class,
      LinkTypePathGenerator::class
    );
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
  public function projects(): BelongsToMany
  {
    return $this->belongsToMany(Project::class)
      ->withPivot('url')
      ->withTimestamps();
  }
}
