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
        Schema::create('pengajuan_surat', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mahasiswa_id')
                ->constrained('mahasiswa')
                ->cascadeOnDelete();

            $table->foreignId('jenis_surat_id')
                ->constrained('jenis_surat')
                ->cascadeOnDelete();

            $table->text('keperluan');

            $table->string('file_pengajuan');

            $table->enum('status', [
                'menunggu_verifikasi',
                'diverifikasi_admin',
                'ditolak_admin',
                'disetujui_kaprodi',
                'ditolak_kaprodi'
            ])->default('menunggu_verifikasi');

            $table->text('catatan_admin')->nullable();
            $table->text('catatan_kaprodi')->nullable();

            $table->timestamp('tanggal_pengajuan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surat');
    }
};
