<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use Illuminate\Http\Request;
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
}
