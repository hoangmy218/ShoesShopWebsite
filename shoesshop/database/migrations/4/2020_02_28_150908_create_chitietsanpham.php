<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChitietsanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietsanpham', function (Blueprint $table) {
            $table->Increments('ctsp_id');
            $table->Integer('sp_ma'); 
            $table->Integer('pn_ma'); 
            $table->Integer('ctsp_kichCo'); 
            $table->Integer('soLuongNhap'); 
            $table->Integer('donGiaNhap');
            $table->Integer('soLuongTon');
            $table->timestamps(); //tự động thêm thời gian tạo
            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham');
            $table->foreign('pn_ma')->references('pn_ma')->on('phieunhap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietsanpham');
    }
}
