<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    $locale = app()->getLocale();
    $galleries = $this->relationLoaded('galleries') ? $this->galleries : collect();

    $isRelatedRoute = $request->routeIs('*related*') ||
      $request->is('*related*') ||
      $request->routeIs('*featured*') ||
      $request->is('*featured*') ||
      $request->routeIs('*top-liked*') ||
      $request->is('*top-liked*');

    $isSummaryMode = $galleries->isNotEmpty() && !$galleries->first()->relationLoaded('media');

    return [
      'id' => $this->id,
      'name' => $this->translated_name,
      'description' => $this->translated_description,
      'likes_count' => $this->likes_count,  
      'country' => $this->translated_country,
      'project_number' => $this->project_number,
      'is_featured' => $this->is_featured,

      'main_image' => $galleries->flatMap(fn($g) => $g->getMedia('photos'))->first()?->getFullUrl() ?: '',
      $this->mergeWhen($isSummaryMode, [
        'gallery_names' => $galleries->map(function ($gallery) use ($locale) {
          return $gallery->name[$locale] ?? $gallery->name['en'] ?? '';
        })->values()->toArray(),
      ]),

      $this->mergeWhen(!$isRelatedRoute, [
        'design_galleries' => GalleryResource::collection($galleries->where('project_section_id', 1)),
        'vr_galleries' => GalleryResource::collection($galleries->where('project_section_id', 2)),
        'real_galleries' => GalleryResource::collection($galleries->where('project_section_id', 3)),
        'links' => $this->linkTypes->map(fn($link) => [
          'id' => $link->id,
          'name' => $link->name[$locale] ?? $link->name['en'] ?? '',
          'url' => $link->pivot->url,
        ]),
      ]),

      'categories' => new CategoryResource($this->whenLoaded('category')),
      'tags' => TagResource::collection($this->whenLoaded('tags')),

      'links' => $this->linkTypes->map(fn($link) => [
        'id' => $link->id,
        'name' => $link->name[$locale] ?? $link->name['en'] ?? '',
        'url' => $link->pivot->url,
      ]),
    ];
  }
}