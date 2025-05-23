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
    Schema::create('menus', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
        $table->string('nama');
        $table->text('deskripsi')->nullable();
        $table->decimal('harga', 10, 2);
        $table->string('gambar')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('menus');
}
};
