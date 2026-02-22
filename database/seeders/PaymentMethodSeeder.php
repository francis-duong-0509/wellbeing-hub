<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // International
            [
                'name' => 'Cash payment',
                'code' => 'cash',
                'country_id' => null,
                'type' => 2,
                'status' => 1,
                'payment_type' => 1,
                'bank_account_info' => null,
                'qr_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Vietnam
            [
                'name' => 'Chuyển khoản ngân hàng',
                'code' => 'banking',
                'country_id' => 243,
                'type' => 1,
                'status' => 1,
                'payment_type' => 2,
                'bank_account_info' => null,
                'qr_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ngân Lượng (có thể dùng thẻ visa/ master card)',
                'code' => 'nganluong',
                'country_id' => 243,
                'type' => 1,
                'status' => 0,
                'payment_type' => 3,
                'bank_account_info' => null,
                'qr_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chuyển khoản ngân hàng 2',
                'code' => 'banking1',
                'country_id' => 243,
                'type' => 1,
                'status' => 1,
                'payment_type' => 2,
                'bank_account_info' => null,
                'qr_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tài khoản thiện nguyện PLV',
                'code' => 'charityfund',
                'country_id' => 243,
                'type' => 1,
                'status' => 1,
                'payment_type' => 2,
                'bank_account_info' => null,
                'qr_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tài khoản thiện nguyện PLG',
                'code' => 'thien_nguyen_PLG',
                'country_id' => 243,
                'type' => 1,
                'status' => 1,
                'payment_type' => 2,
                'bank_account_info' => null,
                'qr_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Thailand
            [
                'name' => 'Bank transfer (Thai bank)',
                'code' => 'banking_thai',
                'country_id' => 221,
                'type' => 1,
                'status' => 1,
                'payment_type' => 2,
                'bank_account_info' => null,
                'qr_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Australia
            [
                'name' => 'Bank transfer (Aus)',
                'code' => 'banking_aus',
                'country_id' => 14,
                'type' => 1,
                'status' => 1,
                'payment_type' => 2,
                'bank_account_info' => null,
                'qr_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        PaymentMethod::insert($data);
    }
}
