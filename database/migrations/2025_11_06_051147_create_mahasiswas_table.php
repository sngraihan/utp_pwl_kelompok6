<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('npm')->unique();
            $table->string('nama');
            $table->string('jurusan')->nullable();
            $table->unsignedSmallInteger('angkatan')->nullable();
            $table->text('kontak_pribadi')->nullable(); // terenkripsi di model
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('mahasiswas');
    }
};
