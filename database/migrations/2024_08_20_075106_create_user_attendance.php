<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_relate_infos', function (Blueprint $table) {
            $table->id()->comment('主键ID,与用户排班相关的用户资料');
            $table->timestamps();
            $table->integer('staff_id')->comment('员工ID');
            $table->string('email')->nullable(true)->comment('员工邮箱');
            $table->string('card_number')->nullable(true)->comment('考勤卡号');
            $table->unique('staff_id');
            $table->index('email');
        });
        Schema::create('user_attendance', function (Blueprint $table) {
            $table->id()->comment('主键ID,用户排班');
            $table->timestamps();
            $table->integer('staff_id')->comment('员工ID');
            $table->dateTime('month')->comment('月份');
            $table->string('o_id_attendance_organ')->nullable(true)->comment('考勤组织id');
            $table->integer('job_type')->nullable(true)->comment('工作制');
            $table->string('o_id_attendance_group')->nullable(true)->comment('隶属考勤组,考勤组OId');
            $table->text('day_data')->comment('月份的日班次id');
            $table->boolean('is_valid')->comment('是否有效true：有效false：无效');
            $table->dateTime('created_time')->comment('创建时间');
            $table->dateTime('modified_time')->nullable(true)->comment('修改时间');
            $table->string('o_id')->nullable(true)->comment('排班管理Id,主键ObjectId');
            $table->unique('staff_id');
            $table->index('o_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_relate_infos');
        Schema::dropIfExists('user_attendance');
    }
};
