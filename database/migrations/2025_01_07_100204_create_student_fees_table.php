<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->double('fees')->default(35000.00);
            $table->text('remarks')->nullable();
            $table->enum('payment_instrument', ['online', 'cash'])->default('cash');
            $table->enum('payment_through', ['RTGS', 'NEFT', 'IMPS', 'UPI', 'CASH'])->default('CASH');
            $table->string('payment_ref_no')->nullable();
            $table->date('due_date');
            $table->date('received_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_fees');
    }
};
