<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the 'system-user' role
        Role::create([
            'name' => 'system-user',
            'guard_name' => 'web',
        ]);

        // Create the 'market-user' role
        Role::create([
            'name' => 'market-user',
            'guard_name' => 'web',
        ]);
    }
}
