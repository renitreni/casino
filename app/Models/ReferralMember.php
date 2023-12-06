<?php

namespace App\Models;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'referral_id',
        'member_id',
        'is_active',
    ];

    public function referral()
    {
        return $this->belongsTo(Referral::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
}
