<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mon_hoc', function (Blueprint $table) {
            $table->id();
            $table->string('ma_mon_hoc', 20)->unique();
            $table->string('ten_mon_hoc', 100);
            $table->integer('tin_chi');
            $table->string('document')->nullable();
            $table->unsignedBigInteger('khoa_id');
            $table->foreign('khoa_id')->references('id')->on('khoa');
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mon_hoc');
    }
}; 