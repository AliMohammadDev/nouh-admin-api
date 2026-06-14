<?php

namespace App\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use Illuminate\Support\Str;

class CustomPathGenerator implements PathGenerator
{

  public function getPath(Media $media): string
  {
    return $this->getBasePath($media) . '/';
  }


  public function getPathForConversions(Media $media): string
  {
    return $this->getBasePath($media) . '/conversions/';
  }


  public function getPathForResponsiveImages(Media $media): string
  {
    return $this->getBasePath($media) . '/responsive/';
  }


  protected function getBasePath(Media $media): string
  {
    if ($media->model_type === \App\Models\ProjectGallery::class) {
      $gallery = $media->model;
      $section = $gallery->section;

      $sectionName = $section->name['en'] ?? 'default-section';
      $sectionSlug = Str::slug($sectionName);

      return "projects/{$sectionSlug}/section-{$section->id}/gallery-{$gallery->id}/{$media->id}";
    }

    return "media/{$media->id}";
  }
}
