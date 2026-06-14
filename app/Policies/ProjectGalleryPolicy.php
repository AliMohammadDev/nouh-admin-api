<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ProjectGallery;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectGalleryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ProjectGallery');
    }

    public function view(AuthUser $authUser, ProjectGallery $projectGallery): bool
    {
        return $authUser->can('View:ProjectGallery');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ProjectGallery');
    }

    public function update(AuthUser $authUser, ProjectGallery $projectGallery): bool
    {
        return $authUser->can('Update:ProjectGallery');
    }

    public function delete(AuthUser $authUser, ProjectGallery $projectGallery): bool
    {
        return $authUser->can('Delete:ProjectGallery');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ProjectGallery');
    }

    public function restore(AuthUser $authUser, ProjectGallery $projectGallery): bool
    {
        return $authUser->can('Restore:ProjectGallery');
    }

    public function forceDelete(AuthUser $authUser, ProjectGallery $projectGallery): bool
    {
        return $authUser->can('ForceDelete:ProjectGallery');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ProjectGallery');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ProjectGallery');
    }

    public function replicate(AuthUser $authUser, ProjectGallery $projectGallery): bool
    {
        return $authUser->can('Replicate:ProjectGallery');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ProjectGallery');
    }

}