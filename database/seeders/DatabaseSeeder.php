<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $adminRole = Role::create(['name' => 'admin']);
        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@site.com',
            'ip_address' => 'localhost',
        ]);
        $user->assignRole($adminRole);

        $agentRole = Role::create(['name' => 'agent']);
        $users = User::factory(10)->create();
        foreach($users as $user) {
            $user->assignRole($agentRole);
        }

        $playerRole = Role::create(['name' => 'player']);
        $users = User::factory(10)->create();
        foreach($users as $user) {
            $user->assignRole($playerRole);
        }
    }
}
