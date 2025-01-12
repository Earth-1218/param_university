<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['electricity', 'salary_payment', 'stationary', 'repairing', 'traveling', 'food', 'cleaning', 'renovation', 'fire_and_safety', 'medical', 'others'])->default('others');
            $table->text('remarks')->nullable();
            $table->date('date');
            $table->enum('payment_instrument', ['online', 'cash'])->default('cash');
            $table->enum('payment_through', ['RTGS', 'NEFT', 'IMPS', 'UPI', 'CASH'])->default('CASH');
            $table->string('payment_ref_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sponsor_id')->default(0);
            $table->enum('category', ['donation', 'fees', 'others'])->default('fees');
            $table->text('remarks')->nullable();
            $table->date('date');
            $table->enum('payment_instrument', ['online', 'cash'])->default('cash');
            $table->enum('payment_through', ['RTGS', 'NEFT', 'IMPS', 'UPI', 'CASH'])->default('CASH');
            $table->string('payment_ref_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('remarks')->nullable();
            $table->date('date');
            $table->enum('payment_instrument', ['online', 'cash'])->default('cash');
            $table->enum('payment_through', ['RTGS', 'NEFT', 'IMPS', 'UPI', 'CASH'])->default('CASH');
            $table->string('payment_ref_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('start')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('organizer')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('event_assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->string('headline')->nullable();
            $table->text('remarks')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('subject_id');
            $table->timestamp('start')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->time('duration');
            $table->integer('total_marks')->default(100);
            $table->integer('passing_marks')->default(40);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exam_papers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->string('paper')->nullable();
            $table->enum('paper_set', ['A', 'B', 'C', 'D']);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('exam_id');
            $table->integer('marks_obtained');
            $table->enum('status', ['pass', 'fail'])->default('fail');
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hostels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->integer('capacity');
            $table->integer('occupied')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('library_books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('isbn');
            $table->integer('quantity')->default(1);
            $table->integer('available')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('book_issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('book_id');
            $table->date('issue_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->double('fine', 8, 2)->default(0.00);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('transport', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_no');
            $table->string('driver_name');
            $table->string('route');
            $table->integer('capacity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transport');
        Schema::dropIfExists('book_issues');
        Schema::dropIfExists('library_books');
        Schema::dropIfExists('hostels');
        Schema::dropIfExists('exam_results');
        Schema::dropIfExists('exam_papers');
        Schema::dropIfExists('exams');
        Schema::dropIfExists('event_assets');
        Schema::dropIfExists('events');
        Schema::dropIfExists('donations');
        Schema::dropIfExists('incomes');
        Schema::dropIfExists('expenses');
    }
};
