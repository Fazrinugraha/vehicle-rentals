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
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id(); // Menggunakan default id
            $table->string('nama_kendaraan', 50);
            $table->enum('jenis_kendaraan', ['mobil', 'motor']);
            $table->enum('status', ['tersedia', 'dipinjam'])->default('tersedia');
            $table->string('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
