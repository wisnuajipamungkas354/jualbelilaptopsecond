<?php

use App\Models\DataLaptop;
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
        Schema::create('laptop_images', function (Blueprint $table) {
            $table->id();
            $table->string('id_laptop');
            $table->foreign('id_laptop')
                ->references('id_laptop')
                ->on('data_laptops');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptop_images');
    }
};
