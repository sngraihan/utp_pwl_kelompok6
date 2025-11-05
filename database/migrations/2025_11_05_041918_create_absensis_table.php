<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penempatan_id')->constrained('penempatans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->cascadeOnUpdate()->restrictOnDelete();
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpha'])->default('alpha');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->text('alasan_izin')->nullable();      // terenkripsi
            $table->text('catatan_harian')->nullable();   // terenkripsi
            $table->boolean('verifikasi_pembimbing')->default(false);
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->unique(['penempatan_id', 'mahasiswa_id', 'tanggal']);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('absensis');
    }
};
