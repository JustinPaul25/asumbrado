<?php

use App\Types\RoleType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(['name' => RoleType::ADMINISTRATOR]);
        Role::firstOrCreate(['name' => RoleType::MID]);
        Role::firstOrCreate(['name' => RoleType::VIEWONLY]);
    }
}
