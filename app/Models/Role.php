<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['name', 'slug', 'guard_name'];

    const ROLE_SLUG_ADMINISTRATOR = 'administrator';
    const ROLE_SLUG_GENERAL_MEMBER = 'general-member';
    const ROLE_SLUG_TEACHER = 'teacher';
    const ROLE_SLUG_THERAPIST = 'therapist';
    const ROLE_SLUG_MASTER= 'master';
    const ROLE_SLUG_ACCOUNTANT= 'accountant';
    const ROLE_SLUG_OPERATOR= 'operator';
    const ROLE_SLUG_CUSTOMER_SERVICE = 'customer-service';
    const ROLE_SLUG_FACILITY = 'facility';
    const ROLE_SLUG_VIP_CLIENT = 'vip-client';    
    const ROLE_SLUG_SUB_ADMIN = 'sub-admin';
    const ROLE_SLUG_HR= 'hr';
    const AVAILABLE_FOR_ALL = "all";

    /*=============================================== RELATIONSHIPS ===============================================*/
    public function administrators(): BelongsToMany {
        return $this->belongsToMany(User::class, 'model_has_roles', 'role_id', 'model_id')->where('model_type', User::class);
    }

    public function permissions(): BelongsToMany {
        return $this->belongsToMany(\Spatie\Permission\Models\Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    }

    /*=============================================== METHODS ===============================================*/
    public static function getAvailableRoles(): array {
        $res = [Role::AVAILABLE_FOR_ALL => Str::title(Role::AVAILABLE_FOR_ALL), ...Role::all()->mapWithKeys(function ($item) {
            $displayName = match ($item->name) {
                'super_admin' => 'Administrator',
                'panel_user', 'panel_admin' => 'General Member',
                default => Str::title(str_replace(['-', '_'], ' ', $item->name)),
            };

            return [strtolower($item->slug) => $displayName];
        })->toArray()];

        return $res;
    }
}
