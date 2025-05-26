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
        Schema::create('nguoi_dung', function (Blueprint $table) {
            $table->id();
            $table->string('ten')->nullable();
            $table->string('ten_dang_nhap')->unique(); // Tên đăng nhập (username)
            $table->string('email')->unique(); // Email
            $table->timestamp('email_verified_at')->nullable(); // Thời gian xác thực email
            $table->string('mat_khau'); // Mật khẩu
            $table->foreignId('vai_tro_id')->constrained('vai_tro'); // Liên kết với bảng vai_tro
            $table->unsignedBigInteger('khoa_id')->nullable();
            $table->foreign('khoa_id')->references('id')->on('khoa');
            $table->boolean('trang_thai')->default(true); // Trạng thái người dùng
            $table->enum('gioi_tinh', ['nam', 'nu'])->nullable(); // Giới tính
            $table->string('sdt')->nullable();
            $table->string('avatar')->nullable();
            $table->string('cccd')->nullable();

            $table->rememberToken(); // Token ghi nhớ phiên đăng nhập
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nguoi_dung');
    }
};
