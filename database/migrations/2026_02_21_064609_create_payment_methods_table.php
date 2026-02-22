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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->string('code', 50);
            $table->unsignedBigInteger('country_id')->nullable();
            $table->tinyInteger('type');
            $table->boolean('status');
            $table->integer('payment_type');
            $table->text('bank_account_info')->nullable();
            $table->string('qr_url', 255)->nullable();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
