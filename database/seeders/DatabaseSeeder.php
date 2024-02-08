<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        //1. Call the RolesAndPermissionsSeeder class
        $this->call(RolesAndPermissionsSeeder::class);
        //2. Call the UserSeeder class
        $this->call(UserSeeder::class);
    }
}
