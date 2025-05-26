<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lich_hoc_mon_hoc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mon_hoc_id')->constrained('mon_hoc')->onDelete('cascade');
            $table->string('ma_lop', 20);
            $table->string('phong_hoc', 50);
            $table->string('thu', 10);
            $table->string('tiet_bat_dau', 10);
            $table->string('tiet_ket_thuc', 10);
            $table->unsignedBigInteger('giang_vien_id');
            $table->foreign('giang_vien_id')->references('id')->on('nguoi_dung');
            $table->integer('so_luong_sv_toi_da')->default(50);
            $table->integer('so_luong_sv_da_dang_ky')->default(0);
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lich_hoc_mon_hoc');
    }
}; 