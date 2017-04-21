<?php

use Illuminate\Database\Seeder;
use Fieldtrip\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $author = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => [
                'create-zones' => true,
            ]
        ]);
        $editor = Role::create([
            'name' => 'Manager',
            'slug' => 'manager',
            'permissions' => [
                'update-zones' => true,
                'create-zones' => true,
            ]
        ]);
    }
}
