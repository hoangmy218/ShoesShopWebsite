<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChitietdonhang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietdonhang', function (Blueprint $table) {
           $table->Integer('dh_ma')->unsigned(); 
            $table->Integer('ctsp_ma')->unsigned(); 
            $table->Integer('soLuongDat'); 
            $table->Integer('thanhTien');
            $table->primary(['dh_ma','ctsp_ma']);
            $table->foreign('dh_ma')->references('dh_ma')->on('donhang');
            $table->foreign('ctsp_ma')->references('sp_ma')->on('sanpham');
             $table->timestamps(); //tự động thêm thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietdonhang');
    }
}
