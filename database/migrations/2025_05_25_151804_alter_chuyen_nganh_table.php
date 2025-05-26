<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::table('chuyen_nganh', function (Blueprint $table) {
          $table->text('chuan_dau_ra')->nullable();
       });
    }

    public function down(): void
    {
        Schema::table('chuyen_nganh', function (Blueprint $table) {
            $table->dropColumn('chuan_dau_ra');
        });
    }
};
