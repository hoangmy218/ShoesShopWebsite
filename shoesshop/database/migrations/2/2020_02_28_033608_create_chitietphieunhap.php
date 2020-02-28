<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChitietphieunhap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietphieunhap', function (Blueprint $table) {
            $table->Integer('pn_ma')->unsigned(); 
            $table->Integer('sp_ma')->unsigned(); 
            $table->Integer('soLuongNhap'); 
            $table->Integer('donGiaNhap');
            $table->timestamps(); //tự động thêm thời gian tạo
            $table->primary(['pn_ma','sp_ma']);
            $table->foreign('pn_ma')->references('pn_ma')->on('phieunhap');
            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietphieunhap');
    }
}
