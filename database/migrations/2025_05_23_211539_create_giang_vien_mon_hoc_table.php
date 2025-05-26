<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('giang_vien_mon_hoc', function (Blueprint $table) {
                $table->id();
                $table->foreignId('mon_hoc_id')->constrained('mon_hoc')->onDelete('cascade');
                $table->foreignId('giang_vien_id')->constrained('nguoi_dung')->onDelete('cascade');
                $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('giang_vien_mon_hoc');
    }
};
