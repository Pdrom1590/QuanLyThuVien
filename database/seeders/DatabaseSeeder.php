<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
    $user = new User();
    $user->name = 'admin';
    $user->email = 'admin@gmail.com';
    $user->password = bcrypt('123456');
    $user->is_admin = true;
    $user->save();

    $user = new User();
    $user->name = 'user';
    $user->email = 'user@gmail.com';
    $user->password = bcrypt('123456');
    $user->is_admin = false;
    $user->save();

    $user1 = new User();
    $user1->name = 'Thiên yêu Bảo';
    $user1->email = 'thien@gmail.com';
    $user1->password = bcrypt('123456');
    $user1->is_admin = false;
    $user1->save();
    }
}
