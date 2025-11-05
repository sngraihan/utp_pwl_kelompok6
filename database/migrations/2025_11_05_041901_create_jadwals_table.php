<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penempatan_id')->constrained('penempatans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('tanggal');
            $table->enum('shift', ['pagi', 'siang', 'sore'])->nullable();
            $table->boolean('wajib')->default(true);
            $table->unique(['penempatan_id', 'tanggal']);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('jadwals');
    }
};
