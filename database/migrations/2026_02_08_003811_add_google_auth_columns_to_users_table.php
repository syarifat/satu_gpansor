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
        Schema::table('users', function (Blueprint $table) {
            // 1. Ubah kolom password menjadi boleh kosong (nullable)
            // Karena user Google tidak punya password lokal
            $table->string('password')->nullable()->change();

            // 2. Tambahkan kolom google_id setelah email
            $table->string('google_id')->nullable()->after('email')->unique();

            // 3. Tambahkan kolom avatar setelah nama (opsional, untuk foto profil)
            $table->string('avatar')->nullable()->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom tambahan jika di-rollback
            $table->dropColumn(['google_id', 'avatar']);

            // Kembalikan password menjadi wajib diisi (NOT NULL)
            // Hati-hati: Rollback ini akan error jika ada user yang password-nya NULL
            $table->string('password')->nullable(false)->change();
        });
    }
};