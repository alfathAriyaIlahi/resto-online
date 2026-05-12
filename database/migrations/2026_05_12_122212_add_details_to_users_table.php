<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek dulu apakah kolom sudah ada sebelum menambah, agar tidak error saat migrate
            if (!Schema::hasColumn('users', 'nomor_hp')) {
                $table->string('nomor_hp')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable()->after('nomor_hp');
            }
            if (!Schema::hasColumn('users', 'foto_profil')) {
                $table->string('foto_profil')->nullable()->after('alamat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nomor_hp', 'alamat', 'foto_profil']);
        });
    }
};
