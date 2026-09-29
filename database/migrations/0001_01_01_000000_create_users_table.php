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
        Schema::create('users', function (Blueprint $table) {
            $table->string('id_user', 50)->primary();
            $table->string('nomor_induk', 50)->nullable();
            $table->string('nama_lengkap', 100);
            $table->enum('role', ['guru', 'operator', 'siswa']);
            $table->string('kelas', 50)
                ->nullable()
                ->comment('Hanya diisi jika role=siswa');
            $table->string('email', 100)->nullable();
            $table->string('password', 255);

            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
