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
        Schema::create('detail_penjualans', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('penjualan_id');
    $table->unsignedBigInteger('menu_id');
    $table->integer('jumlah');
    $table->decimal('harga', 12, 2);
    $table->timestamps();

    $table->foreign('penjualan_id')->references('id')->on('penjualans')->onDelete('cascade')->name('fk_detail_penjualans_penjualan');
    $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade')->name('fk_detail_penjualans_menu');
});

}

public function down()
{
    Schema::dropIfExists('detail_penjualans');
}

};
