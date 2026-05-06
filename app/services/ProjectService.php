<?php


namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectService
{
  public function findAll()
  {
    return Project::with(['category', 'tags', 'linkTypes'])->get();
  }

  public function createProject(array $data, $imageFile = null)
  {
    return DB::transaction(function () use ($data, $imageFile) {
      $project = Project::create($data);

      if (!empty($data['tags'])) {
        $project->tags()->sync($data['tags']);
      }

      if (!empty($data['links'])) {
        foreach ($data['links'] as $link) {
          $project->linkTypes()->attach($link['link_type_id'], ['url' => $link['url']]);
        }
      }

      if ($imageFile) {
        $project->addMedia($imageFile)->toMediaCollection('projects');
      }

      return $project->load(['category', 'tags', 'linkTypes']);
    });
  }

  public function findOne(Project $project)
  {
    return $project->load(['category', 'tags', 'linkTypes']);
  }

  public function updateProject(Project $project, array $data, $imageFile = null)
  {
    return DB::transaction(function () use ($project, $data, $imageFile) {
      $project->update($data);

      if (isset($data['tags'])) {
        $project->tags()->sync($data['tags']);
      }

      if (isset($data['links'])) {
        $formattedLinks = [];
        foreach ($data['links'] as $link) {
          $formattedLinks[$link['link_type_id']] = ['url' => $link['url']];
        }
        $project->linkTypes()->sync($formattedLinks);
      }

      if ($imageFile) {
        $project->clearMediaCollection('projects');
        $project->addMedia($imageFile)->toMediaCollection('projects');
      }

      return $project->fresh(['category', 'tags', 'linkTypes']);
    });
  }

  public function deleteProject(Project $project)
  {
    return $project->delete();
  }
}
