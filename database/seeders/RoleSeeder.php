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
        // Create the 'system-admin' role
        Role::create([
            'name' => 'system-admin',
            'guard_name' => 'web',
        ]);

        // Create the 'market-admin' role
        Role::create([
            'name' => 'market-admin',
            'guard_name' => 'web',
        ]);
    }
}
