<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

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

  public function vrProxy(Request $request)
  {
    $imageUrl = $request->query('url');

    if (!$imageUrl) {
      return response()->json(['error' => 'URL parameter is required'], 400);
    }

    $relativeStoragePath = Str::after($imageUrl, '/storage/');

    if (!Storage::disk('public')->exists($relativeStoragePath)) {
      return response()->json(['error' => 'File not found in storage'], 404);
    }

    $file = Storage::disk('public')->get($relativeStoragePath);
    $mimeType = Storage::disk('public')->mimeType($relativeStoragePath);

    return Response::make($file, 200)
      ->header("Content-Type", $mimeType)
      ->header("Access-Control-Allow-Origin", "*")
      ->header("Access-Control-Allow-Methods", "GET, OPTIONS")
      ->header("Access-Control-Allow-Headers", "Origin, Content-Type, Accept, Authorization")
      ->header("Access-Control-Allow-Credentials", "true");
  }
}
