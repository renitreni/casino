<?php

namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserService
{
    public function storeByRole($validated, $role, $ip)
    {
        $validated['ip_address'] = $ip;

        $user = User::create($validated);
        $role = Role::where('name', 'agent')->first();
        $user->assignRole($role);

        return $user;
    }

    public function updateByRole($validated)
    {
        $user = User::find($validated['id'])
            ->fill([
                'email' => $validated['email'],
                'name' => $validated['name'],
            ]);
        $user->save();

        $user->syncRoles($validated['role']);

        if ($validated['password_update'] == 'true') {
            $user = User::find($validated['id'])
                ->fill(['password' => bcrypt($validated['password'])]);
            $user->save();
        }

        return $user;
    }
}
