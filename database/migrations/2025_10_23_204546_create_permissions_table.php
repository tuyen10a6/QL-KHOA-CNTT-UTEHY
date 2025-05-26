<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('quyen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('nguoi_dung')->onDelete('cascade');
            $table->boolean('can_create_user')->default(false);
            $table->boolean('can_edit_user')->default(false);
            $table->boolean('can_delete_user')->default(false);
            $table->boolean('can_create_device')->default(false);
            $table->boolean('can_edit_device')->default(false);
            $table->boolean('can_delete_device')->default(false);
            $table->boolean('can_create_schedule')->default(false);
            $table->boolean('can_edit_schedule')->default(false);
            $table->boolean('can_delete_schedule')->default(false);
            $table->boolean('can_create_notification')->default(false);
            $table->boolean('can_create_report')->default(false);
            
            // Khoa permissions
            $table->boolean('can_view_khoa')->default(false);
            $table->boolean('can_create_khoa')->default(false);
            $table->boolean('can_edit_khoa')->default(false);
            $table->boolean('can_delete_khoa')->default(false);
            
            // Mon hoc permissions
            $table->boolean('can_view_monhoc')->default(false);
            $table->boolean('can_create_monhoc')->default(false);
            $table->boolean('can_edit_monhoc')->default(false);
            $table->boolean('can_delete_monhoc')->default(false);
            
            // Lich hoc permissions
            $table->boolean('can_view_lichhoc')->default(false);
            $table->boolean('can_create_lichhoc')->default(false);
            $table->boolean('can_edit_lichhoc')->default(false);
            $table->boolean('can_delete_lichhoc')->default(false);
            
            // Dang ky mon hoc permissions
            $table->boolean('can_view_dangkymonhoc')->default(false);
            $table->boolean('can_create_dangkymonhoc')->default(false);
            $table->boolean('can_edit_dangkymonhoc')->default(false);
            $table->boolean('can_delete_dangkymonhoc')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quyen');
    }
};
