<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Nonstandard\Uuid;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => 'Permission View',
            'slug_name' => 'permission-view',
        ]);

        DB::table('permissions')->insert([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => 'Permission Create',
            'slug_name' => 'permission-create',
        ]);

        DB::table('permissions')->insert([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => 'Profile View',
            'slug_name' => 'profile-view',
        ]);

        DB::table('permissions')->insert([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => 'Profile Update',
            'slug_name' => 'profile-update',
        ]);
    }
}
