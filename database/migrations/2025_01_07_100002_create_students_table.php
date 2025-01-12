<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('enrollment_no');
            $table->foreignId('course_id')->constrained('courses');
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('aadhaar_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->date('dob');
            $table->text('about')->nullable();
            $table->enum('merital_status', ['married', 'unmarried'])->default('unmarried');
            $table->timestamp('joining_date')->useCurrent();
            $table->timestamp('departure_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
