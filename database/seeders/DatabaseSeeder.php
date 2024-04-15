<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Role::create([
            'roleId' => Str::uuid(),
            'name' => 'Superadmin',
            'code' => 'superadmin',
        ]);

        Role::create([
            'roleId' => Str::uuid(),
            'name' => 'Admin',
            'code' => 'admin',
        ]);

        Role::create([
            'roleId' => Str::uuid(),
            'name' => 'Teknisi',
            'code' => 'teknisi',
        ]);

        \App\Models\User::factory()->create([
            'userId' => Str::orderedUuid(),
            'name' => 'Superadmin',
            'email' => 'superadmin@cal.medquest.co.id',
            'password' => Hash::make('Calibration24!'),
            'role_id' => 1
        ]);
    }
}
