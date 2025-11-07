<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        // PostgreSQL: adjust check constraint and migrate existing data
        DB::transaction(function () {
            DB::statement("UPDATE users SET role='mahasiswa' WHERE role='user'");
            DB::statement("ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check");
            DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('admin','perusahaan','mahasiswa'))");
        });
    }

    public function down(): void {
        DB::transaction(function () {
            DB::statement("ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check");
            DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('admin','perusahaan','user'))");
            DB::statement("UPDATE users SET role='user' WHERE role='mahasiswa'");
        });
    }
};

