<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User Module Language Lines (Vietnamese)
    |--------------------------------------------------------------------------
    */

    'navigation' => 'Người dùng',
    'model' => 'Người dùng',
    'plural' => 'Người dùng',

    'table' => [
        'columns' => [
            'id' => 'ID',
            'name' => 'Tên',
            'email' => 'Email',
            'phone_number' => 'Số điện thoại',
            'avatar' => 'Ảnh đại diện',
            'is_admin' => 'Quản trị viên',
            'is_active' => 'Hoạt động',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
        ],
    ],

    'filters' => [
        'admin_status' => 'Trạng thái quản trị',
        'active_status' => 'Trạng thái hoạt động',
        'all_users' => 'Tất cả người dùng',
        'admins_only' => 'Chỉ quản trị viên',
        'non_admins_only' => 'Chỉ người dùng thường',
        'active_only' => 'Chỉ đang hoạt động',
        'inactive_only' => 'Chỉ không hoạt động',
    ],

    'form' => [
        'sections' => [
            'basic_info' => 'Thông tin cơ bản',
            'security' => 'Bảo mật',
            'profile' => 'Hồ sơ',
            'permissions' => 'Phân quyền',
            'role' => 'Vai trò & Quyền hạn',
        ],
        'fields' => [
            'name' => 'Tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Xác nhận mật khẩu',
            'phone_number' => 'Số điện thoại',
            'avatar' => 'Ảnh đại diện',
            'is_admin' => 'Quản trị viên',
            'is_active' => 'Hoạt động',
            'role' => 'Vai trò',
        ],
        'placeholders' => [
            'name' => 'Nhập họ và tên',
            'email' => 'Nhập địa chỉ email',
            'password' => 'Nhập mật khẩu',
            'phone_number' => 'Nhập số điện thoại',
        ],
        'help_text' => [
            'is_admin' => 'Cấp quyền quản trị cho người dùng này',
            'is_active' => 'Kích hoạt hoặc vô hiệu hóa tài khoản người dùng',
            'role' => 'Gán một hoặc nhiều vai trò cho người dùng này',
        ],
    ],

    'actions' => [
        'create' => 'Tạo người dùng',
        'edit' => 'Chỉnh sửa người dùng',
        'delete' => 'Xóa người dùng',
        'view' => 'Xem người dùng',
    ],

    'messages' => [
        'created' => 'Tạo người dùng thành công.',
        'updated' => 'Cập nhật người dùng thành công.',
        'deleted' => 'Xóa người dùng thành công.',
    ],

    'shield' => [
        'roles' => 'Vai trò',
        'permissions' => 'Quyền hạn',
        'assign_role' => 'Gán vai trò',
        'super_admin' => 'Quản trị viên cấp cao',
        'admin' => 'Quản trị viên',
        'user' => 'Người dùng',
    ],

];
