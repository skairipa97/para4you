<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';
    protected $description = 'Create an admin user';

    public function handle()
    {
        // Create a new admin user
        $inserted = DB::table('users')->insert([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@para4you.com',
            'tel' => '+212600000000',
            'password' => Hash::make('admin123'),
            'gender' => 'secret', 
            'is_admin' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($inserted) {
            $this->info('Admin user created successfully!');
        } else {
            $this->error('Failed to create admin user.');
        }
    }
} 