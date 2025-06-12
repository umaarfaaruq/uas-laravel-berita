<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles if they don't exist
        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'Editor']);
        Role::firstOrCreate(['name' => 'Wartawan']);

        // Create Admin User and assign role
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );
        $adminUser->assignRole('Admin');

        // Create Editor User and assign role
        $editorUser = User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Editor User',
                'password' => bcrypt('password'),
            ]
        );
        $editorUser->assignRole('Editor');

        // Create Wartawan User and assign role
        $wartawanUser = User::firstOrCreate(
            ['email' => 'wartawan@example.com'],
            [
                'name' => 'Wartawan User',
                'password' => bcrypt('password'),
            ]
        );
        $wartawanUser->assignRole('Wartawan');
    }
}
