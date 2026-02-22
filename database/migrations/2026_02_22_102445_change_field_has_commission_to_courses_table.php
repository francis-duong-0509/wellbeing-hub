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
        Schema::table('courses', function (Blueprint $table) {
            $table->boolean('require_referral')->default(true)->after('state_id')->change();
            $table->boolean('has_commission')->default(true)->after('country_id')->change();
            $table->boolean('enable_registration')->default(true)->after('available_payment_methods')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->boolean('require_referral')->default(false)->after('state_id')->change();
            $table->boolean('has_commission')->default(false)->after('country_id')->change();
            $table->boolean('enable_registration')->default(false)->after('available_payment_methods')->change();
        });
    }
};
