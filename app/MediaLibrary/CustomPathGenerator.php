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

    Log::info("CustomPathGenerator: getPath called", [
      'media_id' => $media->id ?? 'unknown',
      'relative_path' => $path,
      'full_path' => $fullPath,
      'directory_exists' => is_dir($fullPath),
    ]);

    if (!file_exists($fullPath)) {
      try {
        if (!mkdir($fullPath, 0775, true) && !is_dir($fullPath)) {
          Log::error("CustomPathGenerator Error: Failed to create directory", ['full_path' => $fullPath]);
        } else {
          Log::info("CustomPathGenerator: Directory created successfully", ['full_path' => $fullPath]);
        }
      } catch (\Exception $e) {
        Log::error("CustomPathGenerator Exception on mkdir", [
          'error' => $e->getMessage(),
          'full_path' => $fullPath
        ]);
      }
    }

    return $path;
  }

  public function getPathForConversions(Media $media): string
  {
    $path = $this->getBasePath($media) . '/conversions/';
    Log::info("CustomPathGenerator: getPathForConversions called", ['path' => $path]);
    return $path;
  }

  public function getPathForResponsiveImages(Media $media): string
  {
    $path = $this->getBasePath($media) . '/responsive/';
    Log::info("CustomPathGenerator: getPathForResponsiveImages called", ['path' => $path]);
    return $path;
  }

  protected function getBasePath(Media $media): string
  {
    try {
      if ($media->model_type === \App\Models\ProjectGallery::class) {
        $gallery = $media->model;
        if (!$gallery) {
          Log::warning("CustomPathGenerator: ProjectGallery model not found for media", ['media_id' => $media->id]);
          return "media/{$media->id}";
        }

        $section = $gallery->section;
        if (!$section) {
          Log::warning("CustomPathGenerator: Section not found for gallery", ['gallery_id' => $gallery->id]);
          return "projects/gallery-{$gallery->id}/{$media->id}";
        }

        $sectionName = $section->name['en'] ?? 'default-section';
        $sectionSlug = Str::slug($sectionName);

        $base = "projects/{$sectionSlug}/section-{$section->id}/gallery-{$gallery->id}/{$media->id}";

        // === إضافة جديدة: تسجيل رابط الصورة النهائي الذي يتم توليده ===
        Log::info("CustomPathGenerator Debug URL & Path", [
          'media_id' => $media->id,
          'disk' => $media->disk,
          'base_path' => $base,
          'generated_url' => $media->getUrl(), // لتتبع رابط الـ URL الفعلي للمتصفح
          'conversion_url' => $media->hasGeneratedConversion('default') ? $media->getUrl('default') : 'no-conversion'
        ]);

        return $base;
      }
    } catch (\Exception $e) {
      Log::error("CustomPathGenerator Exception in getBasePath: " . $e->getMessage(), [
        'media_id' => $media->id ?? null,
        'model_type' => $media->model_type ?? null
      ]);
    }

    return "media/{$media->id}";
  }
}
