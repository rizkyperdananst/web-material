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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pembeli');
            $table->string('no_nota');
            $table->foreignId('komoditas_id')->nullable()->constrained('komoditas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('satuan');
            $table->string('jumlah');
            $table->string('harga');
            $table->string('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
