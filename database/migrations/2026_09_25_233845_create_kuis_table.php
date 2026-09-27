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
        Schema::create('kuis', function (Blueprint $table) {
            $table->string('id_kuis', 50)->primary();
            $table->string('judul', 150);
            $table->text('deskripsi')->nullable();
            $table->string('kategori', 50)
                ->comment('post-test/pass-test/kuis harian/ulangan/remedial');
            $table->unsignedInteger('alokasi_waktu')
                ->nullable()
                ->comment('Batas waktu pengerjaan dalam menit');
            $table->decimal('kkm', 5, 2)
                ->nullable()
                ->comment('Nilai minimum kelulusan (KKM) untuk kuis ini');
            $table->dateTime('waktu_mulai')
                ->nullable()
                ->comment('Khusus kategori ulangan: kapan ulangan mulai bisa diakses semua siswa');
            $table->dateTime('waktu_selesai')
                ->nullable()
                ->comment('Khusus kategori ulangan: kapan ulangan ditutup, tidak bisa diakses lagi');
            $table->string('id_user', 50)
                ->comment('Guru/operator pembuat kuis (remedial khusus guru)');
            $table->string('status_publikasi', 20)
                ->default('draft')
                ->comment('draft/terbit - validasi isi soal, bukan nilai');
            $table->string('id_publisher', 50)
                ->nullable()
                ->comment('Guru yang mempublikasikan/memvalidasi kuis ini');
            $table->boolean('is_aktif')
                ->default(true)
                ->comment('Soft delete: 0 = diarsipkan/dihapus');
            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->index('id_user', 'fk_kuis_user');
            $table->index('id_publisher', 'fk_kuis_publisher');

            $table->foreign('id_user', 'fk_kuis_user')
                ->references('id_user')
                ->on('users')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('id_publisher', 'fk_kuis_publisher')
                ->references('id_user')
                ->on('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuis');
    }
};
