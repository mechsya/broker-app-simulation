<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Package;
use App\Models\Profile;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('hash123'),
            'country' => 'ID',
            'numberPhone' => '08773899012',
            'role' => 'admin'
        ]);

        Profile::create(['user_id' => $admin->id]);
    }
}
