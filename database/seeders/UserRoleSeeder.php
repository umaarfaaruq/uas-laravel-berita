<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // Import model Role
use Carbon\Carbon; // Import Carbon for timestamps

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan peran 'User' belum ada sebelum membuatnya
        if (!Role::where('name', 'User')->exists()) {
            Role::create([
                'name' => 'User',
                'guard_name' => 'web', // Sesuaikan dengan guard Anda, umumnya 'web'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $this->command->info('Role "User" created successfully.');
        } else {
            $this->command->info('Role "User" already exists.');
        }
    }
}