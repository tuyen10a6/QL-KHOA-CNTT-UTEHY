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
        Schema::create('bao_cao', function (Blueprint $table) {
            $table->id();  // ID báo cáo
            $table->unsignedBigInteger('thiet_bi_id');  // Khóa ngoại của thiết bị
            $table->date('ngay_bao_cao');  // Ngày báo cáo
            $table->text('chi_tiet_bao_cao');  // Chi tiết báo cáo

            // Tạo khóa ngoại
            $table->foreign('thiet_bi_id')->references('id')->on('thiet_bi_pccc')->onDelete('cascade');

            $table->timestamps();  // Thời gian tạo và cập nhật
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bao_cao');
    }
};
