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
            'username' => 'admin',
            'email' => 'firstadmin@mail.com',
            'password' => bcrypt('Admin123,'),
        ]);

        // DB::table('admin_users')->insert([
        //     'name' => 'tobemodified',
        //     'email' => 'tobemodified',
        //     'password' => bcrypt('tobemodified')
        // ]);

        $token = JWTAuth::fromUser($user);

        // You can output the token to the console if needed
        echo "Generated token: " . $token;
    }
}