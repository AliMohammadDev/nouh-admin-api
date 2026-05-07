<?php


namespace App\MediaLibrary;

use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LinkTypePathGenerator implements PathGenerator
{
  public function getPath(Media $media): string
  {
    return 'link_types/' . $media->id . '/';
  }

  public function getPathForConversions(Media $media): string
  {
    return 'link_types/' . $media->id . '/conversions/';
  }

  public function getPathForResponsiveImages(Media $media): string
  {
    return 'link_types/' . $media->id . '/responsive/';
  }
}
