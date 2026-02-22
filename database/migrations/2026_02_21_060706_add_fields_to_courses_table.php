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
            $table->renameColumn('available_payment_method', 'available_payment_methods');

            $table->string('available_for', 100)->nullable()->after('description');
            $table->boolean('require_referral')->default(false)->after('state_id');
            $table->boolean('has_commission')->default(false)->after('country_id');
            $table->boolean('enable_registration')->default(false)->after('available_payment_methods');
            $table->timestamp('modified_at')->nullable()->after('language_code');
            $table->unsignedBigInteger('modified_by')->nullable()->after('modified_at');
            $table->unsignedBigInteger('deleted_by')->nullable()->after('modified_by');
            $table->string('limit_registration', 100)->after('deleted_by')->default('no_limit');
            $table->boolean('is_vip')->default(false)->after('updated_at');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['available_for', 'require_referral', 'has_commission', 'enable_registration', 'modified_at', 'modified_by', 'deleted_by', 'limit_registration', 'is_vip']);
            $table->renameColumn('available_payment_methods', 'available_payment_method');
        });
    }
};
