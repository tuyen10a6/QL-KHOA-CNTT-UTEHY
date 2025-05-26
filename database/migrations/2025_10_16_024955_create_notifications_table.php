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
        Schema::create('thong_bao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dung')->onDelete('cascade');
            $table->string('loai_thong_bao'); // Loại thông báo (cảnh báo, nhắc nhở, v.v.)
            $table->string('tieu_de');
            $table->text('noi_dung'); // Nội dung thông báo
            $table->boolean('da_xem')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('thong_bao');
    }
};




