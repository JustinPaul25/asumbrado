<?php

use App\User;
use App\Types\RoleType;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123123')
        ]);

        $user->assignRole(RoleType::ADMINISTRATOR);
    }
}
