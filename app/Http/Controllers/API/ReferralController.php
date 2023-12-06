<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ReferralController extends Controller
{
    public function referralTable()
    {
        $referral = Referral::with('agent')->get();

        return DataTables::of($referral)
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
}
