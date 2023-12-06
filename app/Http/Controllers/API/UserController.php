<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function agentTable()
    {
        $user = User::with('roles')->whereHas('roles', fn ($q) => $q->where('name', 'agent'));

        return DataTables::of($user)
            ->addColumn('actions', function ($value) {
                return view('project-one.partials.action-btn', ['user' => $value]);
            })
            ->make(true);
    }

    public function playerTable()
    {
        $user = User::with('roles')->whereHas('roles', fn ($q) => $q->where('name', 'player'));

        return DataTables::of($user)
            ->addColumn('actions', function ($value) {
                return view('project-one.partials.action-btn', ['user' => $value]);
            })
            ->make(true);
    }

    public function adminTable()
    {
        $user = User::with('roles')->whereHas('roles', fn ($q) => $q->where('name', 'admin'));

        return DataTables::of($user)
            ->addColumn('actions', function ($value) {
                return view('project-one.partials.action-btn', ['user' => $value]);
            })
            ->make(true);
    }

    public function storeAgent(StoreRequest $request, UserService $userService)
    {
        $userService->storeByRole($request->validated(), 'agent', $request->getClientIp());

        return ['message' => 'success'];
    }

    public function storePlayer(StoreRequest $request, UserService $userService)
    {
        $userService->storeByRole($request->validated(), 'player', $request->getClientIp());

        return ['message' => 'success'];
    }

    public function storeAdmin(StoreRequest $request, UserService $userService)
    {
        $userService->storeByRole($request->validated(), 'admin', $request->getClientIp());

        return ['message' => 'success'];
    }

    public function updateAgent(UpdateRequest $updateRequest, UserService $userService)
    {
        $userService->updateByRole($updateRequest->validated());

        return ['message' => 'success'];
    }

    public function updatePlayer(UpdateRequest $updateRequest, UserService $userService)
    {
        $userService->updateByRole($updateRequest->validated());

        return ['message' => 'success'];
    }

    public function updateAdmin(UpdateRequest $updateRequest, UserService $userService)
    {
        $userService->updateByRole($updateRequest->validated());

        return ['message' => 'success'];
    }

    public function deleteAgent(User $user)
    {
        $user->delete();

        return ['message' => 'success'];
    }

    public function deletePlayer(User $user)
    {
        $user->delete();

        return ['message' => 'success'];
    }

    public function deleteAdmin(User $user)
    {
        $user->delete();

        return ['message' => 'success'];
    }
}
