<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admintoko@gmail.com',
            'password' => bcrypt('TokoAdmin'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir1@gmail.com',
            'password' => bcrypt('TokoKasir1'),
        ]);

        $user->assignRole('user');

        $user2 = User::create([
            'name' => 'Kasir 2',
            'email' => 'kasir2@gmail.com',
            'password' => bcrypt('TokoKasir2'),
        ]);

        $user2->assignRole('user');
    }
}
