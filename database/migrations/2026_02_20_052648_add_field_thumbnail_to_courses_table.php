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
            $table->string('image', 512)->nullable()->change();
            $table->string('thumbnail', 512)->nullable()->after('image');
            $table->boolean('enable_member_discount')->after('available_payment_method')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['thumbnail', 'enable_member_discount']);
            $table->string('image', 512)->change();
        });
    }
};
