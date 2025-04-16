<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $this->call([
        //     RolePermissionSeeder::class
        // ]);

        // $admin = User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@mail.com',
        //     'password' => bcrypt('password'),
        // ]);

        // $admin->assignRole('admin');

        Profile::create([
            'title' => 'Damarkasiyan',
            'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facilis aperiam eveniet perferendis fugiat eum dolore nemo labore error? Aliquid harum et aut facilis velit ex similique ullam saepe rem exercitationem.'
        ]);
    }
}
