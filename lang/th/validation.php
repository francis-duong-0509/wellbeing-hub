<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute ต้องได้รับการยอมรับ',
    'accepted_if' => ':attribute ต้องได้รับการยอมรับเมื่อ :other เป็น :value',
    'active_url' => ':attribute ต้องเป็น URL ที่ใช้งานได้',
    'after' => ':attribute ต้องเป็นวันที่หลังจาก :date',
    'after_or_equal' => ':attribute ต้องเป็นวันที่หลังจากหรือเท่ากับ :date',
    'alpha' => ':attribute ต้องมีเฉพาะตัวอักษร',
    'alpha_dash' => ':attribute ต้องมีเฉพาะตัวอักษร ตัวเลข เครื่องหมายขีดกลาง และขีดล่าง',
    'alpha_num' => ':attribute ต้องมีเฉพาะตัวอักษรและตัวเลข',
    'array' => ':attribute ต้องเป็นอาร์เรย์',
    'ascii' => ':attribute ต้องมีเฉพาะตัวอักษรและตัวเลขแบบไบต์เดียวและสัญลักษณ์',
    'before' => ':attribute ต้องเป็นวันที่ก่อน :date',
    'before_or_equal' => ':attribute ต้องเป็นวันที่ก่อนหรือเท่ากับ :date',
    'between' => [
        'array' => ':attribute ต้องมีจำนวนระหว่าง :min ถึง :max รายการ',
        'file' => ':attribute ต้องมีขนาดระหว่าง :min ถึง :max กิโลไบต์',
        'numeric' => ':attribute ต้องมีค่าระหว่าง :min ถึง :max',
        'string' => ':attribute ต้องมีจำนวนระหว่าง :min ถึง :max ตัวอักษร',
    ],
    'boolean' => ':attribute ต้องเป็นจริงหรือเท็จ',
    'can' => ':attribute มีค่าที่ไม่ได้รับอนุญาต',
    'confirmed' => 'การยืนยัน :attribute ไม่ตรงกัน',
    'contains' => ':attribute ขาดค่าที่จำเป็น',
    'current_password' => 'รหัสผ่านไม่ถูกต้อง',
    'date' => ':attribute ต้องเป็นวันที่ที่ถูกต้อง',
    'date_equals' => ':attribute ต้องเป็นวันที่เดียวกับ :date',
    'date_format' => ':attribute ต้องตรงกับรูปแบบ :format',
    'decimal' => ':attribute ต้องมีทศนิยม :decimal ตำแหน่ง',
    'declined' => ':attribute ต้องถูกปฏิเสธ',
    'declined_if' => ':attribute ต้องถูกปฏิเสธเมื่อ :other เป็น :value',
    'different' => ':attribute และ :other ต้องแตกต่างกัน',
    'digits' => ':attribute ต้องมี :digits หลัก',
    'digits_between' => ':attribute ต้องมีระหว่าง :min ถึง :max หลัก',
    'dimensions' => ':attribute มีขนาดรูปภาพที่ไม่ถูกต้อง',
    'distinct' => ':attribute มีค่าที่ซ้ำกัน',
    'doesnt_end_with' => ':attribute ต้องไม่ลงท้ายด้วยค่าใดค่าหนึ่งต่อไปนี้: :values',
    'doesnt_start_with' => ':attribute ต้องไม่ขึ้นต้นด้วยค่าใดค่าหนึ่งต่อไปนี้: :values',
    'email' => ':attribute ต้องเป็นที่อยู่อีเมลที่ถูกต้อง',
    'ends_with' => ':attribute ต้องลงท้ายด้วยค่าใดค่าหนึ่งต่อไปนี้: :values',
    'enum' => ':attribute ที่เลือกไม่ถูกต้อง',
    'exists' => ':attribute ที่เลือกไม่ถูกต้อง',
    'extensions' => ':attribute ต้องมีนามสกุลไฟล์ดังนี้: :values',
    'file' => ':attribute ต้องเป็นไฟล์',
    'filled' => ':attribute ต้องมีค่า',
    'gt' => [
        'array' => ':attribute ต้องมีมากกว่า :value รายการ',
        'file' => ':attribute ต้องมีขนาดมากกว่า :value กิโลไบต์',
        'numeric' => ':attribute ต้องมีค่ามากกว่า :value',
        'string' => ':attribute ต้องมีจำนวนมากกว่า :value ตัวอักษร',
    ],
    'gte' => [
        'array' => ':attribute ต้องมี :value รายการหรือมากกว่า',
        'file' => ':attribute ต้องมีขนาดมากกว่าหรือเท่ากับ :value กิโลไบต์',
        'numeric' => ':attribute ต้องมีค่ามากกว่าหรือเท่ากับ :value',
        'string' => ':attribute ต้องมีจำนวนมากกว่าหรือเท่ากับ :value ตัวอักษร',
    ],
    'hex_color' => ':attribute ต้องเป็นสี hex ที่ถูกต้อง',
    'image' => ':attribute ต้องเป็นรูปภาพ',
    'in' => ':attribute ที่เลือกไม่ถูกต้อง',
    'in_array' => ':attribute ต้องมีอยู่ใน :other',
    'integer' => ':attribute ต้องเป็นจำนวนเต็ม',
    'ip' => ':attribute ต้องเป็นที่อยู่ IP ที่ถูกต้อง',
    'ipv4' => ':attribute ต้องเป็นที่อยู่ IPv4 ที่ถูกต้อง',
    'ipv6' => ':attribute ต้องเป็นที่อยู่ IPv6 ที่ถูกต้อง',
    'json' => ':attribute ต้องเป็นสตริง JSON ที่ถูกต้อง',
    'list' => ':attribute ต้องเป็นรายการ',
    'lowercase' => ':attribute ต้องเป็นตัวพิมพ์เล็ก',
    'lt' => [
        'array' => ':attribute ต้องมีน้อยกว่า :value รายการ',
        'file' => ':attribute ต้องมีขนาดน้อยกว่า :value กิโลไบต์',
        'numeric' => ':attribute ต้องมีค่าน้อยกว่า :value',
        'string' => ':attribute ต้องมีจำนวนน้อยกว่า :value ตัวอักษร',
    ],
    'lte' => [
        'array' => ':attribute ต้องมีไม่เกิน :value รายการ',
        'file' => ':attribute ต้องมีขนาดน้อยกว่าหรือเท่ากับ :value กิโลไบต์',
        'numeric' => ':attribute ต้องมีค่าน้อยกว่าหรือเท่ากับ :value',
        'string' => ':attribute ต้องมีจำนวนน้อยกว่าหรือเท่ากับ :value ตัวอักษร',
    ],
    'mac_address' => ':attribute ต้องเป็นที่อยู่ MAC ที่ถูกต้อง',
    'max' => [
        'array' => ':attribute ต้องมีไม่เกิน :max รายการ',
        'file' => ':attribute ต้องมีขนาดไม่เกิน :max กิโลไบต์',
        'numeric' => ':attribute ต้องมีค่าไม่เกิน :max',
        'string' => ':attribute ต้องมีจำนวนไม่เกิน :max ตัวอักษร',
    ],
    'max_digits' => ':attribute ต้องมีไม่เกิน :max หลัก',
    'mimes' => ':attribute ต้องเป็นไฟล์ชนิด: :values',
    'mimetypes' => ':attribute ต้องเป็นไฟล์ชนิด: :values',
    'min' => [
        'array' => ':attribute ต้องมีอย่างน้อย :min รายการ',
        'file' => ':attribute ต้องมีขนาดอย่างน้อย :min กิโลไบต์',
        'numeric' => ':attribute ต้องมีค่าอย่างน้อย :min',
        'string' => ':attribute ต้องมีจำนวนอย่างน้อย :min ตัวอักษร',
    ],
    'min_digits' => ':attribute ต้องมีอย่างน้อย :min หลัก',
    'missing' => ':attribute ต้องไม่มีค่า',
    'missing_if' => ':attribute ต้องไม่มีค่าเมื่อ :other เป็น :value',
    'missing_unless' => ':attribute ต้องไม่มีค่าเว้นแต่ :other เป็น :value',
    'missing_with' => ':attribute ต้องไม่มีค่าเมื่อมี :values',
    'missing_with_all' => ':attribute ต้องไม่มีค่าเมื่อมี :values ทั้งหมด',
    'multiple_of' => ':attribute ต้องเป็นพหุคูณของ :value',
    'not_in' => ':attribute ที่เลือกไม่ถูกต้อง',
    'not_regex' => 'รูปแบบของ :attribute ไม่ถูกต้อง',
    'numeric' => ':attribute ต้องเป็นตัวเลข',
    'password' => [
        'letters' => ':attribute ต้องมีอย่างน้อยหนึ่งตัวอักษร',
        'mixed' => ':attribute ต้องมีอย่างน้อยหนึ่งตัวพิมพ์ใหญ่และหนึ่งตัวพิมพ์เล็ก',
        'numbers' => ':attribute ต้องมีอย่างน้อยหนึ่งตัวเลข',
        'symbols' => ':attribute ต้องมีอย่างน้อยหนึ่งสัญลักษณ์',
        'uncompromised' => ':attribute ที่ระบุได้รั่วไหลในข้อมูลรั่วไหล กรุณาเลือก :attribute อื่น',
    ],
    'present' => ':attribute ต้องมีค่า',
    'present_if' => ':attribute ต้องมีค่าเมื่อ :other เป็น :value',
    'present_unless' => ':attribute ต้องมีค่าเว้นแต่ :other เป็น :value',
    'present_with' => ':attribute ต้องมีค่าเมื่อมี :values',
    'present_with_all' => ':attribute ต้องมีค่าเมื่อมี :values ทั้งหมด',
    'prohibited' => ':attribute ถูกห้าม',
    'prohibited_if' => ':attribute ถูกห้ามเมื่อ :other เป็น :value',
    'prohibited_unless' => ':attribute ถูกห้ามเว้นแต่ :other อยู่ใน :values',
    'prohibits' => ':attribute ห้ามไม่ให้ :other มีค่า',
    'regex' => 'รูปแบบของ :attribute ไม่ถูกต้อง',
    'required' => 'โปรดระบุ :attribute',
    'required_array_keys' => ':attribute ต้องมีรายการสำหรับ: :values',
    'required_if' => 'โปรดระบุ :attribute เมื่อ :other คือ :value',
    'required_if_accepted' => 'โปรดระบุ :attribute เมื่อ :other ได้รับการยอมรับ',
    'required_if_declined' => 'โปรดระบุ :attribute เมื่อ :other ถูกปฏิเสธ',
    'required_unless' => 'โปรดระบุ :attribute เว้นแต่ :other อยู่ใน :values',
    'required_with' => 'โปรดระบุ :attribute เมื่อมี :values',
    'required_with_all' => 'โปรดระบุ :attribute เมื่อมี :values ทั้งหมด',
    'required_without' => 'โปรดระบุ :attribute เมื่อไม่มี :values',
    'required_without_all' => 'โปรดระบุ :attribute เมื่อไม่มี :values ใดเลย',
    'same' => ':attribute และ :other ต้องตรงกัน',
    'size' => [
        'array' => ':attribute ต้องมี :size รายการ',
        'file' => ':attribute ต้องมีขนาด :size กิโลไบต์',
        'numeric' => ':attribute ต้องมีค่า :size',
        'string' => ':attribute ต้องมีจำนวน :size ตัวอักษร',
    ],
    'starts_with' => ':attribute ต้องขึ้นต้นด้วยค่าใดค่าหนึ่งต่อไปนี้: :values',
    'string' => ':attribute ต้องเป็นข้อความ',
    'timezone' => ':attribute ต้องเป็นเขตเวลาที่ถูกต้อง',
    'unique' => ':attribute นี้ถูกใช้ไปแล้ว',
    'uploaded' => 'การอัปโหลด :attribute ล้มเหลว',
    'uppercase' => ':attribute ต้องเป็นตัวพิมพ์ใหญ่',
    'url' => ':attribute ต้องเป็น URL ที่ถูกต้อง',
    'ulid' => ':attribute ต้องเป็น ULID ที่ถูกต้อง',
    'uuid' => ':attribute ต้องเป็น UUID ที่ถูกต้อง',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
