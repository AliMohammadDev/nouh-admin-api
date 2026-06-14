<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    $locale = app()->getLocale();

    return [
      'id' => $this->id,
      'album_name' => $this->name[$locale] ?? $this->name['en'] ?? '',
      'images' => $this->getMedia('photos')->map(fn($media) => [
        'original' => $media->getFullUrl(),
        'thumbnail' => $media->getFullUrl('default'),
      ])->values()->toArray(),
    ];
  }
}
