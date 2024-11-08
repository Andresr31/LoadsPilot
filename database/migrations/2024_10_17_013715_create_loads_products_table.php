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
        Schema::create('loads_products', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
                                                                     ->onDelete('cascade');

            $table->unsignedBigInteger('load_id')->nullable();
            $table->foreign('load_id')->references('id')->on('loads')->onUpdate('cascade')
                                                                     ->onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')
                                                                           ->onDelete('cascade');

            $table->unsignedBigInteger('tacho_id');
            $table->foreign('tacho_id')->references('id')->on('tachos')->onUpdate('cascade')
                                                                       ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loads_products');
    }
};
