<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('item_histories', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('item_id'); // Foreign key ke tabel items
            $table->integer('quantity'); // Jumlah item
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('item_histories');
    }
};
