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
        Schema::table('items', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->default(0)->change(); // Mengatur default harga menjadi 0
        });
    }
    
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->nullable(false)->change(); // Mengembalikan pengaturan lama
        });
    }
    
};