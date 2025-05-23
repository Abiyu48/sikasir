<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelian', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('pembelian_id');
    $table->unsignedBigInteger('menu_id'); // perbaiki dari 'menus_id'
    $table->integer('jumlah');
    $table->decimal('harga_beli', 12, 2);
    $table->timestamps();

    $table->foreign('pembelian_id')->references('id')->on('pembelian')->onDelete('cascade');
    $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade'); // nama tabel 'menus' sesuai migrasi menu
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pembelian');
    }
};
