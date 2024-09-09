<?php

namespace Database\Seeders;

use App\Models\NdcAppointment;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        foreach (range(1, 20) as $key => $value) {
            NdcAppointment::create([
                'user_id' => rand(1, 13),
                'appoint_mentor' => $faker->name,
                'purpose' => 'asdfasdfasdf',
                'belong' => 'asdfasdfasdf',
                'date' => $faker->date,
                'time' => $faker->time,
                'entry_time' => 'asdfasdfasdf',
                'status' => 'Pending',
            ]);
        }
    }
}
