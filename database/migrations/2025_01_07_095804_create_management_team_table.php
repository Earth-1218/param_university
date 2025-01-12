<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('management_team', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->date('dob');
            $table->text('about')->nullable();
            $table->enum('department', ['president', 'hod', 'trustee', 'dean', 'admin', 'accountant', 'librarian', 'clerk', 'guard', 'others'])->default('others');
            $table->timestamp('joining_date')->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('management_team');
    }
};
