<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('mon_hoc', function (Blueprint $table) {
            $table->string('loai_mon')->nullable();
            $table->integer('so_tiet_ly_thuyet')->nullable();
            $table->integer('so_tiet_thuc_hanh')->default(0);
            $table->integer('so_tiet_tu_hoc')->default(0);
            $table->text('ghi_chu')->nullable();
            $table->unsignedBigInteger('chuyen_nganh_id')->nullable();
            $table->foreign('chuyen_nganh_id')->references('id')->on('chuyen_nganh');
        });
    }

    public function down(): void
    {
         Schema::table('mon_hoc', function (Blueprint $table) {
            $table->dropColumn('loai_mon');
            $table->dropColumn('so_tiet_ly_thuyet');
            $table->dropColumn('so_tiet_thuc_hanh');
            $table->dropColumn('so_tiet_tu_hoc');
            $table->dropColumn('ghi_chu');
            $table->dropForeign('mon_hoc_chuyen_nganh_id_foreign');
            $table->dropColumn('chuyen_nganh_id');
         });
    }
};
