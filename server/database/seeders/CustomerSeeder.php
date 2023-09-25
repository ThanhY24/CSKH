<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CustomerModel;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo 10 bản ghi mẫu
        for ($i = 1; $i <= 10; $i++) {
            CustomerModel::create([
                'cus_name' => 'Customer ' . $i,
                'cus_birthday' => now(),
                'cus_gender' => rand(0, 1),
                'cus_phone' => '123456789',
                'cus_email' => 'customer' . $i . '@example.com',
                'cus_password'=>md5('123456789'),
                'cus_taxID'=>'12345678910',
                'cus_address'=>'Cần Thơ',
                'cus_address_ship'=>'Cần Thơ',
                'cus_status' => 1, 
            ]);
        }
    }
}
