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
        Schema::create('data_pembelians', function (Blueprint $table) {
            $table->string('id_pembelian')->unique();
            $table->primary('id_pembelian');
            $table->string('nm_pembeli');
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('mtd_pembayaran');
            $table->string('id_laptop');
            $table->foreign('id_laptop')->references('id_laptop')->on('data_laptops');
            $table->integer('jml_barang');
            $table->integer('total_pembayaran');
            $table->string('status_pembelian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pembelians');
    }
};
