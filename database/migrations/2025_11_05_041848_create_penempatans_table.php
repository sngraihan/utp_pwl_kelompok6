<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('penempatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('perusahaan_id')->constrained('perusahaans')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('pembimbing_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->enum('status', ['aktif', 'selesai'])->default('aktif');
            $table->unique(['mahasiswa_id', 'perusahaan_id', 'status']);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('penempatans');
    }
};
