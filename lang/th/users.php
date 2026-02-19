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

    'navigation' => 'ผู้ใช้',
    'model' => 'ผู้ใช้',
    'plural' => 'ผู้ใช้',

    'table' => [
        'columns' => [
            'id' => 'รหัส',
            'name' => 'ชื่อ',
            'email' => 'อีเมล',
            'phone_number' => 'เบอร์โทรศัพท์',
            'avatar' => 'รูปประจำตัว',
            'is_admin' => 'ผู้ดูแลระบบ',
            'is_active' => 'ใช้งานอยู่',
            'created_at' => 'สร้างเมื่อ',
            'updated_at' => 'อัปเดตเมื่อ',
        ],
    ],

    'filters' => [
        'admin_status' => 'สถานะผู้ดูแลระบบ',
        'active_status' => 'สถานะการใช้งาน',
        'all_users' => 'ผู้ใช้ทั้งหมด',
        'admins_only' => 'เฉพาะผู้ดูแลระบบ',
        'non_admins_only' => 'เฉพาะผู้ใช้ทั่วไป',
        'active_only' => 'เฉพาะที่ใช้งานอยู่',
        'inactive_only' => 'เฉพาะที่ไม่ใช้งาน',
    ],

    'form' => [
        'sections' => [
            'basic_info' => 'ข้อมูลพื้นฐาน',
            'security' => 'ความปลอดภัย',
            'profile' => 'โปรไฟล์',
            'permissions' => 'สิทธิ์',
            'role' => 'บทบาทและสิทธิ์',
        ],
        'fields' => [
            'name' => 'ชื่อ',
            'email' => 'อีเมล',
            'password' => 'รหัสผ่าน',
            'password_confirmation' => 'ยืนยันรหัสผ่าน',
            'phone_number' => 'เบอร์โทรศัพท์',
            'avatar' => 'รูปประจำตัว',
            'is_admin' => 'ผู้ดูแลระบบ',
            'is_active' => 'ใช้งานอยู่',
            'role' => 'บทบาท',
        ],
        'placeholders' => [
            'name' => 'กรอกชื่อเต็ม',
            'email' => 'กรอกอีเมล',
            'password' => 'กรอกรหัสผ่าน',
            'phone_number' => 'กรอกเบอร์โทรศัพท์',
        ],
        'help_text' => [
            'is_admin' => 'ให้สิทธิ์ผู้ดูแลระบบกับผู้ใช้นี้',
            'is_active' => 'เปิดหรือปิดการใช้งานบัญชีผู้ใช้',
            'role' => 'มอบหมายบทบาทหนึ่งหรือหลายบทบาทให้กับผู้ใช้นี้',
        ],
    ],

    'actions' => [
        'create' => 'สร้างผู้ใช้',
        'edit' => 'แก้ไขผู้ใช้',
        'delete' => 'ลบผู้ใช้',
        'view' => 'ดูผู้ใช้',
    ],

    'messages' => [
        'created' => 'สร้างผู้ใช้สำเร็จ',
        'updated' => 'อัปเดตผู้ใช้สำเร็จ',
        'deleted' => 'ลบผู้ใช้สำเร็จ',
    ],

    'shield' => [
        'roles' => 'บทบาท',
        'permissions' => 'สิทธิ์',
        'assign_role' => 'มอบหมายบทบาท',
        'super_admin' => 'ผู้ดูแลระบบสูงสุด',
        'admin' => 'ผู้ดูแลระบบ',
        'user' => 'ผู้ใช้',
    ],

];
