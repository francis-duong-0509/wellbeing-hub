<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::where('name', 'super_admin')->first();
        if ($superAdmin && empty($superAdmin->slug)) {
            $superAdmin->update(['slug' => Str::slug('administrator')]);
        }

        $panelUser = Role::where('name', 'panel_user')->first();
        if ($panelUser && empty($panelUser->slug)) {
            $panelUser->update(['slug' => Str::slug('general-member')]);
        }

        $roleNames = [
            'Teacher',
            'Therapist',
            'Master',
            'Accountant',
            'Operator',
            'Customer Service',
            'Facility',
            'Vip Client',
            'Sub Admin',
            'Human Resources'
        ];

        foreach ($roleNames as $roleName) {            
            Role::firstOrCreate(
                ['name' => $roleName, 'guard_name' => 'web'],
                ['slug' => Str::slug($roleName)]
            );
        }
    }
}
