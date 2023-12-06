<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('referral_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referral_id')->constrained(); // 'referral_id',
            $table->foreignId('member_id')->nullable()->constrained('users'); // 'member_id',
            $table->integer('is_active')->default(1); // 'is_active',
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_members');
    }
};
