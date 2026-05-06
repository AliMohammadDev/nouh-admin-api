<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\services\ProjectService;

class ProjectController extends Controller
{
  public function __construct(
    private ProjectService  $projectService
  ) {}

  public function index()
  {
    $projects = $this->projectService->findAll();
    return ProjectResource::collection($projects);
  }

  public function store(CreateProjectRequest $request)
  {
    $project = $this->projectService->createProject(
      $request->validated(),
      $request->file('image')
    );
    return new ProjectResource($project);
  }

  public function show(Project $project)
  {
    return new ProjectResource($this->projectService->findOne($project));
  }

  public function update(UpdateProjectRequest $request, Project $project)
  {
    $updatedProject = $this->projectService->updateProject(
      $project,
      $request->validated(),
      $request->file('image')
    );
    return new ProjectResource($updatedProject);
  }

  public function destroy(Project $project)
  {
    $this->projectService->deleteProject($project);
    return response()->json(['message' => 'Project deleted successfully']);
  }
}
