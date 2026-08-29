<?php

namespace App\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CustomPathGenerator implements PathGenerator
{
  public function getPath(Media $media): string
  {
    $path = $this->getBasePath($media) . '/';
    $fullPath = storage_path('app/public/' . $path);

    if (!file_exists($fullPath)) {
      try {
        mkdir($fullPath, 0775, true);
      } catch (\Exception $e) {
        Log::error("CustomPathGenerator Exception on mkdir: " . $e->getMessage());
      }
    }

    return $path;
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
      if ($gallery && $gallery->section) {
        $section = $gallery->section;
        $sectionName = $section->name['en'] ?? 'default-section';
        $sectionSlug = Str::slug($sectionName);

        return "projects/{$sectionSlug}/section-{$section->id}/gallery-{$gallery->id}/{$media->id}";
      }
    }

    return "media/{$media->id}";
  }
}
