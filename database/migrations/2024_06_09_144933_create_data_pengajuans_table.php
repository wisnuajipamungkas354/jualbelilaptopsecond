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
        Schema::create('data_pengajuans', function (Blueprint $table) {
            $table->string('id_pengajuan')->unique();
            $table->primary('id_pengajuan');
            $table->string('nm_penjual');
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('platform');
            $table->string('merk', 25);
            $table->string('tipe', 100);
            $table->string('processor');
            $table->string('memory', 50);
            $table->string('storage', 50);
            $table->string('uk_layar', 15);
            $table->enum('is_touchscreen', ['Ya', 'Tidak']);
            $table->string('info_tambahan')->nullable();
            $table->string('kelengkapan', 100);
            $table->string('minus')->nullable();
            $table->integer('harga');
            $table->char('grade', 1)->nullable();
            $table->integer('jml_barang');
            $table->string('status_pengajuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pengajuans');
    }
};
