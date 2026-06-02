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
        Schema::create('mst_vendors', function (Blueprint $table) {
            $table->id();
            $table->string('code_vendor')->unique();
            $table->string('nama_vendor');
            $table->string('penanggung_jawab');
            $table->string('email')->unique();
            $table->string('telepon');
            $table->text('alamat');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes(); // Menggunakan soft deletes untuk keamanan data aset
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_vendors');
    }
};
