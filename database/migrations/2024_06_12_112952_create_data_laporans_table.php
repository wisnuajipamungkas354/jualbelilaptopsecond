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
        Schema::create('data_laporans', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->primary('id');
            $table->string('tahun');
            $table->string('bulan');
            $table->integer('terjual');
            $table->integer('dibeli');
            $table->integer('pemasukan');
            $table->integer('pengeluaran');
            $table->integer('jml_trx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_laporans');
    }
};
