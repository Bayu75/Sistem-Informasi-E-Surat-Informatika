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
    Schema::create('pengumuman', function (Blueprint $table) {

        $table->id();

        $table->string('judul');

        $table->string('kategori');

        $table->text('ringkasan');

        $table->longText('isi')->nullable();

        $table->string('file')->nullable();

        $table->date('tanggal');

        $table->enum('status', [
            'Aktif',
            'Nonaktif'
        ])->default('Aktif');

        $table->foreignId('created_by')
              ->constrained('users')
              ->cascadeOnDelete();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('pengumuman');
    }
};
