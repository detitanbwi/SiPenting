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
        // Tambahkan unique constraint pada kolom name di tabel akun_bapeda
        Schema::table('akun_bapeda', function (Blueprint $table) {
            $table->unique('name');
        });

        // Tambahkan unique constraint pada kolom name di tabel akun_puskesmas
        Schema::table('akun_puskesmas', function (Blueprint $table) {
            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus unique constraint dari kolom name di tabel akun_bapeda
        Schema::table('akun_bapeda', function (Blueprint $table) {
            $table->dropUnique(['name']);
        });

        // Hapus unique constraint dari kolom name di tabel akun_puskesmas
        Schema::table('akun_puskesmas', function (Blueprint $table) {
            $table->dropUnique(['name']);
        });
    }
};
