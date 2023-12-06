<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterMemberRequest;
use App\Models\Referral;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ReferralController extends Controller
{
    public function referralTable()
    {
        $referral = Referral::with('agent')->get();

        return DataTables::of($referral)
            ->editColumn('referral_link', function($value){
                return route('referral.register', ['code' => $value->referral_link]);
            })
            ->addColumn('actions', function ($value) {
                return view('project-one.partials.action-referral-btn', ['data' => $value]);
            })
            ->make(true);
    }

    public function deleteReferral(Referral $referral)
    {
        $referral->referralMember()->delete();
        $referral->delete();

        return ['message' => 'success'];
    }

    public function createReferral(Request $request)
    {
        $user = User::findOrFail($request->get('id'));

        Referral::create([
            'agent_id' => $user->id,
            'referral_link' => Str::uuid(),
            'is_active' => 1,
        ]);

        return ['message' => 'success'];
    }

    public function registerMember(RegisterMemberRequest $request, UserService $userService)
    {
        $userService->storeByRole($request->validated(), 'player', $request->getClientIp());

        dd($request->input());
    }
}
