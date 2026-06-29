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

            // Mahasiswa pengaju
            $table->foreignId('mahasiswa_id')
                ->constrained('mahasiswa')
                ->cascadeOnDelete();

            // Jenis surat
            $table->foreignId('jenis_surat_id')
                ->constrained('jenis_surat')
                ->cascadeOnDelete();

            // Keperluan pengajuan
            $table->text('keperluan');

            // File yang diupload mahasiswa
            $table->string('file_pengajuan');

            // File surat final yang telah ditandatangani Kaprodi
            $table->string('file_ttd')->nullable();

            // Status pengajuan
            $table->enum('status', [
                'menunggu_verifikasi',
                'diverifikasi_admin',
                'ditolak_admin',
                'disetujui_kaprodi',
                'ditolak_kaprodi'
            ])->default('menunggu_verifikasi');

            // Catatan penolakan atau revisi
            $table->text('catatan_admin')->nullable();
            $table->text('catatan_kaprodi')->nullable();

            // Tanggal proses
            $table->timestamp('tanggal_pengajuan');
            $table->timestamp('tanggal_verifikasi_admin')->nullable();
            $table->timestamp('tanggal_keputusan_kaprodi')->nullable();

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
