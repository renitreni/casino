<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Referral;
use App\Models\ReferralMember;
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

        $playerRole = Role::create(['name' => 'player']);
        $agentRole = Role::create(['name' => 'agent']);
        $agents = User::factory(10)->has(
            Referral::factory()
                ->has(
                    ReferralMember::factory(10)
                        ->afterCreating(
                            function ($referralMember) use ($playerRole) {
                                User::factory()
                                    ->afterCreating(function ($user) use ($playerRole, $referralMember) {
                                        $referralMember->update(['member_id' => $user->id]);
                                        $user->assignRole($playerRole);
                                    })
                                    ->create();
                            }
                        )
                )
        )->create();

        foreach ($agents as $agent) {
            $agent->assignRole($agentRole);
        }

        // $playerRole = Role::create(['name' => 'player']);
        // $users = User::factory(10)->create();
        // foreach ($users as $user) {
        //     $user->assignRole($playerRole);
        // }
    }
}
