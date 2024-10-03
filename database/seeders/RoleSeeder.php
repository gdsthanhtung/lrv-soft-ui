<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'Administrator',
            'permission' => '["admin.dashboard","admin.user","admin.user.form","admin.user.delete","admin.user.change-status","admin.user.save","admin.role","admin.role.form","admin.role.delete","admin.role.change-status","admin.role.save","admin.logout","admin.login"]',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

