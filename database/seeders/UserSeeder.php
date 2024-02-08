<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Delete all existing users
        User::truncate();

        //Create superadmin
        $this->createSuperadminUser();
    }
    private function createSuperadminUser(): UserSeeder
    {
        //Create the superadmin user
        $superadmin = User::factory()->create([
            'email' => 'admin@steadfast.test',
            'password' => '123456',
        ]);

        //Assign superadmin role to the superadmin user
        $superadmin->assignRole('superadmin');

        return $this;
    }

}
