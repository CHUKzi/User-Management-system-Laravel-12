<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'royanharsha6@gmail.com'],
            [
                'name' => 'Royan Harsha',
                'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
            ]
        );
    }
}
