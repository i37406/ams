<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('attendance')->nullable();
            $table->string('leave_reason')->nullable();
            $table->boolean('leave_apply_status')->default(false);
            $table->boolean('leave_approved_status')->default(false);
            $table->boolean('leave_disapprove_status')->default(false);
            $table->boolean('seen_status')->default(false);
            $table->timestamp('attendance_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance');
    }
}
