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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique();
            $table->string('name', 255);
            $table->float('price');
            $table->decimal('discount_percent', 5, 2)->nullable()->default(0);
            $table->timestamp('discount_until')->nullable();
            $table->string('type', 50);
            $table->timestamp('fromdate');
            $table->timestamp('todate');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('description');
            $table->string('image', 512);
            $table->string('available_payment_method', 100);
            $table->unsignedBigInteger('created_by');
            $table->string('language_code', 10);
            $table->unsignedBigInteger('currency_id');

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
        Schema::dropIfExists('events');
    }
};
