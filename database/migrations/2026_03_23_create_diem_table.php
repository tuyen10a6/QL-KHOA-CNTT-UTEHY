<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('diem', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dang_ky_mon_hoc_id')->constrained('dang_ky_mon_hoc')->onDelete('cascade');
            $table->decimal('diem_giua_ky', 4, 2)->nullable();
            $table->decimal('diem_cuoi_ky', 4, 2)->nullable();
            $table->decimal('diem_tong_ket', 4, 2)->nullable();
            $table->string('xep_loai', 10)->nullable();
            $table->text('nhan_xet')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diem');
    }
}; 