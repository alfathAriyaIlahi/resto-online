<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
    Schema::create('kupons', function (Blueprint $table) {
        $table->id();
        $table->string('kode_kupon')->unique();
        $table->enum('jenis_diskon', ['nominal', 'persen']);
        $table->integer('nilai_diskon');
        $table->integer('min_pembelian')->default(0);
        $table->date('berlaku_sampai');
        $table->integer('kuota')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kupons');
    }
};
