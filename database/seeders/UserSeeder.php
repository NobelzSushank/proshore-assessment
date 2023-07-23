<?php

namespace Database\Seeders;

use App\Enums\RoleTypeEnum;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')
            ->insert([
                [
                    'id' => Str::uuid(),
                    'role_id' => Role::where('slug', RoleTypeEnum::ADMIN->value)->value('id'),
                    'name' => 'Admin',
                    'email' => 'admin@example.com',
                    'password' => Hash::make('password123'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'role_id' => Role::where('slug', RoleTypeEnum::STUDENT->value)->value('id'),
                    'name' => 'Student',
                    'email' => 'student@example.com',
                    'password' => Hash::make('password123'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
    }
}
