<?php

namespace Database\Seeders;

use A17\Twill\Models\User as TwillUser;
use A17\Twill\Repositories\UserRepository;
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
        // Create default admin user
        User::updateOrCreate(
            ['email' => 'laravel@humanfrog.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('root')
            ]
        );

        // Create twill admin user
        if (!TwillUser::where('email', 'laravel@humanfrog.com')->exists()) {
            $twillUserRepository = app(UserRepository::class);
            $twillUserRepository->create(
                [
                    'email' => 'laravel@humanfrog.com',
                    'name' => 'Admin',
                    'role' => 'SUPERADMIN',
                    'published' => true,
                    'password' => Hash::make('root')
                ]
            );
        }

        $this->call(RoomSeeder::class);
    }
}
