<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    const AVAILABLE_FOR_ALL = "all";
    const ROLE_HR= 'hr';

    /*=============================================== RELATIONSHIPS ===============================================*/
    public function administrators(): BelongsToMany {
        return $this->belongsToMany(User::class, 'model_has_roles', 'role_id', 'model_id')->where('model_type', User::class);
    }

    public function permissions(): BelongsToMany {
        return $this->belongsToMany(\Spatie\Permission\Models\Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    }
}
