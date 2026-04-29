<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('alat_id')->constrained()->cascadeOnDelete();
            $table->integer('jumlah')->default(1);
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->date('tgl_dikembalikan')->nullable();
            $table->string('status')->default('menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};