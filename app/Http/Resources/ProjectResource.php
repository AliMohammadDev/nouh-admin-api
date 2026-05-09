<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
      'name' => $this->translated_name,
      'description' => $this->translated_description,
      'project_number' => $this->project_number,
      'image' => $this->getFirstMediaUrl('projects', 'default'),
      'all_images' => $this->getMedia('projects')->map(function ($media) {
        return $media->getUrl('default');
      }),
      'category' => new CategoryResource($this->whenLoaded('category')),
      'tags' => TagResource::collection($this->whenLoaded('tags')),
      'links' => $this->linkTypes->map(fn($link) => [
        'id' => $link->id,
        'name' => $link->name,
        'url' => $link->pivot->url,
      ]),
    ];
  }
}
