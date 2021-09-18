<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'Admin@test.com',
                'role_id' => '1',
                'password' => bcrypt('admin123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
   
}
