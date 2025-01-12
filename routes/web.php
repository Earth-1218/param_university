<?php

use App\Http\Controllers\{AuthController, StudentController, CategoryController, CourseController, DonationController, EventController, ExamController, ExpenseController, FacultyController, HostelController, IncomeController, LectureController, LessonController, ManagementStaffController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

// Guest routes
Route::get('/login', [AuthController::class, 'loginFrom'])->name('loginForm');
Route::post('/login', [AuthController::class, 'loginFrom'])->name('loginSubmit');
Route::get('/register', [AuthController::class, 'register'])->name('register');

// Auth routes default
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::prefix('students')->group(function () {
        Route::get('/data', [StudentController::class, 'getData'])->name('students.data');
        Route::get('/add', [StudentController::class, 'add'])->name('students.add');
        Route::get('/', [StudentController::class, 'index'])->name('students.index');
        Route::get('/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/store', [StudentController::class, 'store'])->name('students.store');
        Route::get('/{student}', [StudentController::class, 'show'])->name('students.show');
        Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('/{student}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/data', [CategoryController::class, 'getData'])->name('categories.data');
        Route::get('/add', [CategoryController::class, 'add'])->name('categories.add');
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    Route::prefix('courses')->group(function () {
        Route::get('/data', [CourseController::class, 'getData'])->name('courses.data');
        Route::get('/add', [CourseController::class, 'add'])->name('courses.add');
        Route::get('/', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/store', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/{course}', [CourseController::class, 'show'])->name('courses.show');
        Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/{course}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    });

    Route::prefix('donations')->group(function () {
        Route::get('/data', [DonationController::class, 'getData'])->name('donations.data');
        Route::get('/add', [DonationController::class, 'add'])->name('donations.add');
        Route::get('/', [DonationController::class, 'index'])->name('donations.index');
        Route::get('/create', [DonationController::class, 'create'])->name('donations.create');
        Route::post('/store', [DonationController::class, 'store'])->name('donations.store');
        Route::get('/{donation}', [DonationController::class, 'show'])->name('donations.show');
        Route::get('/{donation}/edit', [DonationController::class, 'edit'])->name('donations.edit');
        Route::put('/{donation}', [DonationController::class, 'update'])->name('donations.update');
        Route::delete('/{donation}', [DonationController::class, 'destroy'])->name('donations.destroy');
    });

    Route::prefix('events')->group(function () {
        Route::get('/data', [EventController::class, 'getData'])->name('events.data');
        Route::get('/add', [EventController::class, 'add'])->name('events.add');
        Route::get('/', [EventController::class, 'index'])->name('events.index');
        Route::get('/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/store', [EventController::class, 'store'])->name('events.store');
        Route::get('/{event}', [EventController::class, 'show'])->name('events.show');
        Route::get('/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    });

    Route::prefix('exams')->group(function () {
        Route::get('/data', [ExamController::class, 'getData'])->name('exams.data');
        Route::get('/add', [ExamController::class, 'add'])->name('exams.add');
        Route::get('/', [ExamController::class, 'index'])->name('exams.index');
        Route::get('/create', [ExamController::class, 'create'])->name('exams.create');
        Route::post('/store', [ExamController::class, 'store'])->name('exams.store');
        Route::get('/{exam}', [ExamController::class, 'show'])->name('exams.show');
        Route::get('/{exam}/edit', [ExamController::class, 'edit'])->name('exams.edit');
        Route::put('/{exam}', [ExamController::class, 'update'])->name('exams.update');
        Route::delete('/{exam}', [ExamController::class, 'destroy'])->name('exams.destroy');
    });

    Route::prefix('expenses')->group(function () {
        Route::get('/data', [ExpenseController::class, 'getData'])->name('expenses.data');
        Route::get('/add', [ExpenseController::class, 'add'])->name('expenses.add');
        Route::get('/', [ExpenseController::class, 'index'])->name('expenses.index');
        Route::get('/create', [ExpenseController::class, 'create'])->name('expenses.create');
        Route::post('/store', [ExpenseController::class, 'store'])->name('expenses.store');
        Route::get('/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
        Route::get('/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
        Route::put('/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
        Route::delete('/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
    });

    Route::prefix('faculties')->group(function () {
        Route::get('/data', [FacultyController::class, 'getData'])->name('faculties.data');
        Route::get('/add', [FacultyController::class, 'add'])->name('faculties.add');
        Route::get('/', [FacultyController::class, 'index'])->name('faculties.index');
        Route::get('/create', [FacultyController::class, 'create'])->name('faculties.create');
        Route::post('/store', [FacultyController::class, 'store'])->name('faculties.store');
        Route::get('/{faculty}', [FacultyController::class, 'show'])->name('faculties.show');
        Route::get('/{faculty}/edit', [FacultyController::class, 'edit'])->name('faculties.edit');
        Route::put('/{faculty}', [FacultyController::class, 'update'])->name('faculties.update');
        Route::delete('/{faculty}', [FacultyController::class, 'destroy'])->name('faculties.destroy');
    });

    Route::prefix('hostels')->group(function () {
        Route::get('/data', [HostelController::class, 'getData'])->name('hostels.data');
        Route::get('/add', [HostelController::class, 'add'])->name('hostels.add');
        Route::get('/', [HostelController::class, 'index'])->name('hostels.index');
        Route::get('/create', [HostelController::class, 'create'])->name('hostels.create');
        Route::post('/store', [HostelController::class, 'store'])->name('hostels.store');
        Route::get('/{hostel}', [HostelController::class, 'show'])->name('hostels.show');
        Route::get('/{hostel}/edit', [HostelController::class, 'edit'])->name('hostels.edit');
        Route::put('/{hostel}', [HostelController::class, 'update'])->name('hostels.update');
        Route::delete('/{hostel}', [HostelController::class, 'destroy'])->name('hostels.destroy');
    });

    Route::prefix('incomes')->group(function () {
        Route::get('/data', [IncomeController::class, 'getData'])->name('incomes.data');
        Route::get('/add', [IncomeController::class, 'add'])->name('incomes.add');
        Route::get('/', [IncomeController::class, 'index'])->name('incomes.index');
        Route::get('/create', [IncomeController::class, 'create'])->name('incomes.create');
        Route::post('/store', [IncomeController::class, 'store'])->name('incomes.store');
        Route::get('/{income}', [IncomeController::class, 'show'])->name('incomes.show');
        Route::get('/{income}/edit', [IncomeController::class, 'edit'])->name('incomes.edit');
        Route::put('/{income}', [IncomeController::class, 'update'])->name('incomes.update');
        Route::delete('/{income}', [IncomeController::class, 'destroy'])->name('incomes.destroy');
    });

    Route::prefix('lectures')->group(function () {
        Route::get('/data', [LectureController::class, 'getData'])->name('lectures.data');
        Route::get('/add', [LectureController::class, 'add'])->name('lectures.add');
        Route::get('/', [LectureController::class, 'index'])->name('lectures.index');
        Route::get('/create', [LectureController::class, 'create'])->name('lectures.create');
        Route::post('/store', [LectureController::class, 'store'])->name('lectures.store');
        Route::get('/{lecture}', [LectureController::class, 'show'])->name('lectures.show');
        Route::get('/{lecture}/edit', [LectureController::class, 'edit'])->name('lectures.edit');
        Route::put('/{lecture}', [LectureController::class, 'update'])->name('lectures.update');
        Route::delete('/{lecture}', [LectureController::class, 'destroy'])->name('lectures.destroy');
    });

    Route::prefix('lessons')->group(function () {
        Route::get('/data', [LessonController::class, 'getData'])->name('lessons.data');
        Route::get('/add', [LessonController::class, 'add'])->name('lessons.add');
        Route::get('/', [LessonController::class, 'index'])->name('lessons.index');
        Route::get('/create', [LessonController::class, 'create'])->name('lessons.create');
        Route::post('/store', [LessonController::class, 'store'])->name('lessons.store');
        Route::get('/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
        Route::get('/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
        Route::put('/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
        Route::delete('/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
    });

    Route::prefix('management-staff')->group(function () {
        Route::get('/data', [ManagementStaffController::class, 'getData'])->name('management-staff.data');
        Route::get('/add', [ManagementStaffController::class, 'add'])->name('management-staff.add');
        Route::get('/', [ManagementStaffController::class, 'index'])->name('management-staff.index');
        Route::get('/create', [ManagementStaffController::class, 'create'])->name('management-staff.create');
        Route::post('/store', [ManagementStaffController::class, 'store'])->name('management-staff.store');
        Route::get('/{staff}', [ManagementStaffController::class, 'show'])->name('management-staff.show');
        Route::get('/{staff}/edit', [ManagementStaffController::class, 'edit'])->name('management-staff.edit');
        Route::put('/{staff}', [ManagementStaffController::class, 'update'])->name('management-staff.update');
        Route::delete('/{staff}', [ManagementStaffController::class, 'destroy'])->name('management-staff.destroy');
    });
});
