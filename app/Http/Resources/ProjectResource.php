<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    $locale = app()->getLocale();
    $mediaCollection = $this->media;

    $sectionProperty = $locale === 'ar' ? 'section_ar' : 'section_en';
    $fallbackProperty = $locale === 'ar' ? 'section_en' : 'section_ar';

    return [
      'id' => $this->id,
      'name' => $this->translated_name,
      'description' => $this->translated_description,
      'likes_count' => $this->likes_count,
      'country' => $this->translated_country,
      'project_number' => $this->project_number,
      'is_featured' => $this->is_featured,

      'image' => $this->getFirstMediaUrl('projects', 'default')
        ?: $this->getFirstMediaUrl('projects')
        ?: $mediaCollection->where('collection_name', 'design_images')->first()?->getFullUrl()
        ?: '',

      'design_images' => $mediaCollection->where('collection_name', 'design_images')
        ->groupBy(fn($m) => $m->getCustomProperty($sectionProperty) ?? $m->getCustomProperty($fallbackProperty) ?? ($locale === 'ar' ? 'عام' : 'general'))
        ->map(
          fn($items) => $items->map(fn($m) => $m->getFullUrl())->values()->toArray()
        )
        ->toArray(),

      'vr_images' => $mediaCollection->where('collection_name', 'vr_images')
        ->groupBy(fn($m) => $m->getCustomProperty($sectionProperty) ?? $m->getCustomProperty($fallbackProperty) ?? ($locale === 'ar' ? 'عام' : 'general'))
        ->map(
          fn($items) => $items->map(fn($m) => $m->getFullUrl())->values()->toArray()
        )
        ->toArray(),

      'real_images' => $mediaCollection->where('collection_name', 'real_images')
        ->groupBy(fn($m) => $m->getCustomProperty($sectionProperty) ?? $m->getCustomProperty($fallbackProperty) ?? ($locale === 'ar' ? 'عام' : 'general'))
        ->map(
          fn($items) => $items->map(fn($m) => $m->getFullUrl())->values()->toArray()
        )
        ->toArray(),

      'category' => new CategoryResource($this->whenLoaded('category')),
      'tags' => TagResource::collection($this->whenLoaded('tags')),

      'links' => $this->linkTypes->map(fn($link) => [
        'id' => $link->id,
        'name' => $link->name[$locale] ?? $link->name['en'] ?? '',
        'url' => $link->pivot->url,
      ]),
    ];
  }
}
