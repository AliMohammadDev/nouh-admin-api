<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserImageResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'images' => $this->getMedia('user_images')->map(function ($media) {
        return [
          'id' => $media->id,
          'original' => $media->getFullUrl(),
          'thumbnail' => $media->getFullUrl('default'),
        ];
      }),
    ];
  }
}
