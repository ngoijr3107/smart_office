<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Paschal Mizengo',
            'email' => 'admin@test.com',
            'phone' => '0786397123',
            'company' => 'Techvilla',
            'user_type' => '99',
            'status' => '1',
            'email_verified_at' => '2023-02-20 20:34:00',
            'password' => bcrypt('12345678')
        ]);
    }
}
