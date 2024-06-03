<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'username' => 'Super Admin',
            'email' => 'firstadmin@mail.com',
            'password' => bcrypt('Admin123,'),
        ]);
        
        $token = JWTAuth::fromUser($user);

        // You can output the token to the console if needed
        echo "Generated token: " . $token;
    }
}