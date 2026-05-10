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
      'url_youtube' => $this->url_youtube,
      'image' => $this->getFirstMediaUrl('projects', 'default'),
      'image_vr' => $this->getFirstMediaUrl('vr_images', 'default'),

      // 'all_images' => $this->when($request->routeIs('projects.show'), function () {
      //   $media = $this->getMedia('projects');
      //   return $media->isNotEmpty() ? $media->map(fn($m) => $m->getUrl())->toArray() : [];
      // }),

      // 'all_images_vr' => $this->when($request->routeIs('projects.show'), function () {
      //   $media = $this->getMedia('vr_images');
      //   return $media->isNotEmpty() ? $media->map(fn($m) => $m->getUrl())->toArray() : [];
      // }),

      'all_images' => $this->when($request->routeIs('projects.show'), function () {
        return $this->getMedia('projects')->map(function ($media) {
          return $media->getFullUrl();
        })->toArray();
      }),

      'all_images_vr' => $this->when($request->routeIs('projects.show'), function () {
        return $this->getMedia('vr_images')->map(function ($media) {
          return $media->getFullUrl();
        })->toArray();
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
