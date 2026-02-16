<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@dinas-kediri.go.id',
            ],
            [
                'name' => 'Admin Dinas',
                'password' => Hash::make('admin12345'),
            ]
        );
    }
}
