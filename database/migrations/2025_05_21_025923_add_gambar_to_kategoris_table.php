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
    Schema::table('kategoris', function (Blueprint $table) {
        $table->string('gambar')->nullable()->after('nama');
    });
}

public function down()
{
    Schema::table('kategoris', function (Blueprint $table) {
        $table->dropColumn('gambar');
    });
}

};
