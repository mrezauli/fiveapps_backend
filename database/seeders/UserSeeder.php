<?php

namespace Database\Seeders;

use App\Models\User;
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
            'app_name' => '_all_',
            'active' => true,
            'password' => Hash::make(12345600),
        ]);

        $bcc = User::create([
            'name' => 'Touch',
            'email' => 'admin@bcc.com',
            'app_name' => 'bcc_connect',
            'active' => true,
            'password' => Hash::make(12345600),
        ]);

        $nttn = User::create([
            'name' => 'Touch',
            'email' => 'admin@nttn.com',
            'app_name' => 'bcc_connect',
            'active' => true,
            'password' => Hash::make(12345600),
        ]);

        $superadmin->assignRole('Super Admin');
        $bcc->assignRole('BCC');
        $nttn->assignRole('NTTN');

    }
}
