<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $superadmin = User::create([
            'name' => 'Touch',
            'email' => 'admin@touchandsolve.com',
            'phone' => '01' . mt_rand(1000000, 9999999),
            'mobile_verify_code' => random_int(111111, 999999),
            'app_name' => '_all_',
            'active' => true,
            'password' => Hash::make(12345600),
        ]);

        $bcc = User::create([
            'name' => 'Touch',
            'email' => 'admin@bcc.com',
            'phone' => '01' . mt_rand(1000000, 9999999),
            'mobile_verify_code' => random_int(111111, 999999),
            'app_name' => 'bcc_connect',
            'active' => true,
            'password' => Hash::make(12345600),
        ]);

        $nttn = User::create([
            'name' => 'Touch',
            'email' => 'admin@nttn.com',
            'phone' => '01' . mt_rand(1000000, 9999999),
            'mobile_verify_code' => random_int(111111, 999999),
            'app_name' => 'bcc_connect',
            'active' => true,
            'password' => Hash::make(12345600),
        ]);

        $superadmin->assignRole('Super Admin');
        $bcc->assignRole('BCC');
        $nttn->assignRole('NTTN');

    }
}