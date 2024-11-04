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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('material');
            $table->string('reference');
            $table->string('lote');
            $table->string('qr_url')->nullable();
            $table->date('date_of_manufacture')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('amount')->nullable();
            $table->string('lote_provider')->nullable();
            $table->string('responsible')->nullable();


            // Foreign Keys
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('SET NULL')->onDelete('SET NULL');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
