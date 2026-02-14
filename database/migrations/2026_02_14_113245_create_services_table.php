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
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->float('price');
            $table->string('type', 50);
            $table->integer('time')->nullable();
            $table->text('description');
            $table->boolean('is_done')->default(false);
            $table->timestamp('is_done_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('image', 512);
            $table->string('discount_type', 50)->nullable();
            $table->float('discount_price')->nullable();
            $table->timestamp('discount_until')->nullable();
            $table->string('available_payment_method', 100);
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('currency_id');
            $table->string('language_code', 10);

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('currency_id')->references('id')->on('currencies');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
