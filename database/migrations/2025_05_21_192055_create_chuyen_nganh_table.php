<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chuyen_nganh', function (Blueprint $table) {
            $table->id();
            $table->string('ten_chuyen_nganh');
            $table->unsignedBigInteger('nganh_id');
            $table->foreign('nganh_id')->references('id')->on('nganh');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chuyen_nganh');
    }
};
