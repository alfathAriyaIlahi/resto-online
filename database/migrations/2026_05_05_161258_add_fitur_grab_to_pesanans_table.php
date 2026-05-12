<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('pesanans', function (Blueprint $table) {
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->enum('metode_pengiriman', ['ambil_sendiri', 'pesan_antar'])->default('ambil_sendiri');
        $table->text('alamat_lengkap')->nullable();
        $table->string('kode_promo')->nullable();
    });
}


    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            //
        });
    }
};
