<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dang_ky_mon_hoc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sinh_vien_id')->constrained('nguoi_dung')->onDelete('cascade');
            $table->foreignId('mon_hoc_id')->constrained('mon_hoc')->onDelete('cascade');
            $table->unsignedBigInteger('lich_hoc_mon_hoc_id');
            $table->foreign('lich_hoc_mon_hoc_id')->references('id')->on('lich_hoc_mon_hoc');
            $table->string('ma_lop', 20);
            $table->string('phong_hoc', 50);
            $table->string('thu', 10);
            $table->string('tiet_bat_dau', 10);
            $table->string('tiet_ket_thuc', 10);
            $table->string('giang_vien', 100);
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dang_ky_mon_hoc');
    }
}; 