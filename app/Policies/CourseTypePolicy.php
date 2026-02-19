<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CourseType;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseTypePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CourseType');
    }

    public function view(AuthUser $authUser, CourseType $courseType): bool
    {
        return $authUser->can('View:CourseType');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CourseType');
    }

    public function update(AuthUser $authUser, CourseType $courseType): bool
    {
        return $authUser->can('Update:CourseType');
    }

    public function delete(AuthUser $authUser, CourseType $courseType): bool
    {
        return $authUser->can('Delete:CourseType');
    }

    public function restore(AuthUser $authUser, CourseType $courseType): bool
    {
        return $authUser->can('Restore:CourseType');
    }

    public function forceDelete(AuthUser $authUser, CourseType $courseType): bool
    {
        return $authUser->can('ForceDelete:CourseType');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CourseType');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CourseType');
    }

    public function replicate(AuthUser $authUser, CourseType $courseType): bool
    {
        return $authUser->can('Replicate:CourseType');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CourseType');
    }

}