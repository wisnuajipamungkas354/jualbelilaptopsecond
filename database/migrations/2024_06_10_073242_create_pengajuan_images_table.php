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
        Schema::create('pengajuan_images', function (Blueprint $table) {
            $table->id();
            $table->string('id_pengajuan');
            $table->foreign('id_pengajuan')
                ->references('id_pengajuan')
                ->on('data_pengajuans');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_images');
    }
};
