<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Nonstandard\Uuid;

class PermissionProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permission_profile')->insert([
            'permission_id' => 1,
            'profile_id' => 1,
        ]);

        DB::table('permission_profile')->insert([
            'permission_id' => 2,
            'profile_id' => 1,
        ]);

        DB::table('permission_profile')->insert([
            'permission_id' => 3,
            'profile_id' => 1,
        ]);

        DB::table('permission_profile')->insert([
            'permission_id' => 4,
            'profile_id' => 1,
        ]);
    }
}
