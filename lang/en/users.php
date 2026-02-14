<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User Module Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in the User resource throughout
    | the application, including navigation labels, table columns, filters,
    | form fields, and action labels.
    |
    */

    'navigation' => 'Users',
    'model' => 'User',
    'plural' => 'Users',

    'table' => [
        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'avatar' => 'Avatar',
            'is_admin' => 'Admin',
            'is_active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ],
    ],

    'filters' => [
        'admin_status' => 'Admin Status',
        'active_status' => 'Active Status',
        'all_users' => 'All users',
        'admins_only' => 'Admins only',
        'non_admins_only' => 'Non-admins only',
        'active_only' => 'Active only',
        'inactive_only' => 'Inactive only',
    ],

    'form' => [
        'sections' => [
            'basic_info' => 'Basic Information',
            'security' => 'Security',
            'profile' => 'Profile',
            'permissions' => 'Permissions',
        ],
        'fields' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Confirm Password',
            'phone_number' => 'Phone Number',
            'avatar' => 'Avatar',
            'is_admin' => 'Administrator',
            'is_active' => 'Active',
        ],
        'placeholders' => [
            'name' => 'Enter full name',
            'email' => 'Enter email address',
            'password' => 'Enter password',
            'phone_number' => 'Enter phone number',
        ],
        'help_text' => [
            'is_admin' => 'Grant administrative privileges to this user',
            'is_active' => 'Activate or deactivate user account',
        ],
    ],

    'actions' => [
        'create' => 'Create User',
        'edit' => 'Edit User',
        'delete' => 'Delete User',
        'view' => 'View User',
    ],

    'messages' => [
        'created' => 'User created successfully.',
        'updated' => 'User updated successfully.',
        'deleted' => 'User deleted successfully.',
    ],

    'shield' => [
        'roles' => 'Roles',
        'permissions' => 'Permissions',
        'assign_role' => 'Assign Role',
        'super_admin' => 'Super Admin',
        'admin' => 'Admin',
        'user' => 'User',
    ],

];
