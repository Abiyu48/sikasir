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
    Schema::table('penjualans', function (Blueprint $table) {
            $table->string('no_bon')->nullable()->after('id');
            $table->string('status_pembayaran')->after('tanggal');
            $table->string('order_type');
            $table->string('total',12,2);
});
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penjualans', function (Blueprint $table) {
                $table->dropColumn(['no_bon','status_pembayaran','order_type','total']);
            
        });
    }
};
