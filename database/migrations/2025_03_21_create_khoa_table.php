<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('khoa', function (Blueprint $table) {
            $table->id();
            $table->string('ten_khoa', 100);
            $table->string('ma_khoa', 20)->unique();
            $table->text('mo_ta')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('khoa');
    }
}; 