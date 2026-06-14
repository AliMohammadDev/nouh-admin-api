<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

#[Fillable(['project_section_id', 'project_id', 'name'])]
class ProjectGallery extends Model implements HasMedia
{
  use InteractsWithMedia, HasFactory;

  protected $casts = [
    'name' => 'array',
  ];

  public function getTranslatedNameAttribute(): string
  {
    return $this->name[app()->getLocale()]
      ?? $this->name['en']
      ?? '';
  }

  public function project()
  {
    return $this->belongsTo(Project::class);
  }
  public function section()
  {
    return $this->belongsTo(
      ProjectSection::class,
      'project_section_id'
    );
  }

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('photos');
  }

  // public function registerMediaConversions(Media $media = null): void
  // {
  //   $this->addMediaConversion('thumb')
  //     ->width(360)
  //     ->height(270)
  //     ->sharpen(10)
  //     ->nonQueued();
  // }

  public function registerMediaConversions(?Media $media = null): void
  {
    $this->addMediaConversion('default')
      ->fit(Fit::Max, 1000, 1000)
      ->quality(70)
      ->format('webp')
      ->nonQueued();
  }
}
