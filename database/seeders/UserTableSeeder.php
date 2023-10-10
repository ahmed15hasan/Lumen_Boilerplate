<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@dukangi.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123#'),
            'role_id' => 1
        ]);

        User::factory()->create([
            'name' => 'Vendor',
            'email' => 'vendor@dukangi.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123#'),
            'role_id' => 2
        ]);

        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@dukangi.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123#'),
            'role_id' => 3
        ]); 
    }
}
