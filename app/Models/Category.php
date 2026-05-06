<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['major_id', 'name', 'description'])]
class Category extends Model
{
  use HasFactory;

  protected $casts = [
    'name' => 'array',
    'description' => 'array',
  ];

  public function getTranslatedNameAttribute(): string
  {
    return $this->name[app()->getLocale()]
      ?? $this->name['en']
      ?? '';
  }

  public function getTranslatedDescriptionAttribute(): string
  {
    return $this->description[app()->getLocale()]
      ?? $this->description['en']
      ?? '';
  }

  public function major(): BelongsTo
  {
    return $this->belongsTo(Major::class);
  }
}
