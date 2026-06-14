<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ProjectSection;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectSectionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ProjectSection');
    }

    public function view(AuthUser $authUser, ProjectSection $projectSection): bool
    {
        return $authUser->can('View:ProjectSection');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ProjectSection');
    }

    public function update(AuthUser $authUser, ProjectSection $projectSection): bool
    {
        return $authUser->can('Update:ProjectSection');
    }

    public function delete(AuthUser $authUser, ProjectSection $projectSection): bool
    {
        return $authUser->can('Delete:ProjectSection');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ProjectSection');
    }

    public function restore(AuthUser $authUser, ProjectSection $projectSection): bool
    {
        return $authUser->can('Restore:ProjectSection');
    }

    public function forceDelete(AuthUser $authUser, ProjectSection $projectSection): bool
    {
        return $authUser->can('ForceDelete:ProjectSection');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ProjectSection');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ProjectSection');
    }

    public function replicate(AuthUser $authUser, ProjectSection $projectSection): bool
    {
        return $authUser->can('Replicate:ProjectSection');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ProjectSection');
    }

}