<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['project_id', 'link_type_id', 'url'])]
class ProjectLink extends Model
{
  protected $table = 'link_type_project';
  public function project(): BelongsTo
  {
    return $this->belongsTo(Project::class);
  }

  public function linkType(): BelongsTo
  {
    return $this->belongsTo(LinkType::class);
  }
}
