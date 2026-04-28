<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('pemasukans', function (Blueprint $table) {
        $table->unsignedBigInteger('transaksi_id')->nullable()->after('total');
    });
}

public function down()
{
    Schema::table('pemasukans', function (Blueprint $table) {
        $table->dropColumn('transaksi_id');
    });
}
};
