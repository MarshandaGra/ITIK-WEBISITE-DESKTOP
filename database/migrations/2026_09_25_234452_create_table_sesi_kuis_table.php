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
        Schema::create('sesi_kuis', function (Blueprint $table) {
            $table->integer('id_sesi')->autoIncrement();
            $table->string('id_kuis', 50);
            $table->string('id_user', 50)
                ->comment('Siswa yang memulai kuis');
            $table->timestamp('waktu_mulai')->useCurrent();

            $table->primary('id_sesi');
            $table->unique(['id_kuis', 'id_user'], 'uq_sesi_kuis_siswa');
            $table->index('id_user', 'fk_sesi_user');

            $table->foreign('id_kuis', 'fk_sesi_kuis')
                ->references('id_kuis')
                ->on('kuis')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('id_user', 'fk_sesi_user')
                ->references('id_user')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_kuis');
    }
};
