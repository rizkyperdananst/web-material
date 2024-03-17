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
        Schema::table('sales', function (Blueprint $table) {
            $table->string('no_spb')->nullable();
            $table->string('status')->nullable();
            $table->string('supir')->nullable();
            $table->string('no_plat')->nullable();
            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->string('no_hp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('no_spb');
            $table->dropColumn('status');
            $table->dropColumn('supir');
            $table->dropColumn('no_plat');
            $table->dropColumn('jam_masuk');
            $table->dropColumn('jam_keluar');
            $table->dropColumn('no_hp');
        });
    }
};
