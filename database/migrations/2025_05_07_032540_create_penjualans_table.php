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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembeli_id');
            $table->unsignedBigInteger('kasir_id');
            $table->date('tanggal_pesan');
            $table->timestamps();
            $table->foreign('pembeli_id')->references('id')->on('pembelis');
            $table->foreign('kasir_id')->references('id')->on('logins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};