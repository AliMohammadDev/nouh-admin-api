<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\LinkType;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinkTypePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:LinkType');
    }

    public function view(AuthUser $authUser, LinkType $linkType): bool
    {
        return $authUser->can('View:LinkType');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:LinkType');
    }

    public function update(AuthUser $authUser, LinkType $linkType): bool
    {
        return $authUser->can('Update:LinkType');
    }

    public function delete(AuthUser $authUser, LinkType $linkType): bool
    {
        return $authUser->can('Delete:LinkType');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:LinkType');
    }

    public function restore(AuthUser $authUser, LinkType $linkType): bool
    {
        return $authUser->can('Restore:LinkType');
    }

    public function forceDelete(AuthUser $authUser, LinkType $linkType): bool
    {
        return $authUser->can('ForceDelete:LinkType');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:LinkType');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:LinkType');
    }

    public function replicate(AuthUser $authUser, LinkType $linkType): bool
    {
        return $authUser->can('Replicate:LinkType');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:LinkType');
    }

}