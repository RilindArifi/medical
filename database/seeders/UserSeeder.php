<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
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
        $roles = collect(RolesEnum::values());

        $role = $roles->random(rand(1, count($roles)));

        User::factory(10)->create()->each(function ($user) use ($role) {
           $user->syncRoles($role);
        });
    }
}
