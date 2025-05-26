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
        Schema::create('thiet_bi_pccc', function (Blueprint $table) {
            $table->id();
            $table->string('ten_thiet_bi');
            $table->string('nha_cung_cap');
            $table->integer('so_luong');
            $table->string('vi_tri');
            $table->date('ngay_lap_dat');
            $table->date('ngay_kiem_tra_gan_nhat')->nullable();
            $table->string('tinh_trang');
            $table->string('hinh_anh');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('thiet_bi_pccc');
    }
};
