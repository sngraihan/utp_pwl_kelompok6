<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->text('alamat')->nullable();
            $table->string('pic')->nullable();
            $table->string('kontak')->nullable();
            $table->foreignId('owner_user_id')->nullable()
                  ->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('perusahaans');
    }
};
