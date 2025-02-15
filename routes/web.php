<?php

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

use App\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

use App\Http\Controllers\ActivitiesController;

Route::resource('activities', ActivitiesController::class);

use App\Http\Controllers\BulletinsController;

Route::resource('bulletins', BulletinsController::class);

use App\Http\Controllers\FacultiesController;

Route::resource('faculties', FacultiesController::class);

use App\Http\Controllers\ProgramsController;

Route::resource('programs', ProgramsController::class);

use App\Http\Controllers\CoursesController;

Route::resource('courses', CoursesController::class);

use App\Http\Controllers\ProgramFacultiesController;

Route::resource('program_faculties', ProgramFacultiesController::class);

use App\Http\Controllers\AcademicCalendarsController;

Route::resource('academic_calendars', AcademicCalendarsController::class);

use App\Http\Controllers\ClassSchedulesController;

Route::resource('class-schedules', ClassSchedulesController::class);

use App\Http\Controllers\ProposalExamsController;

Route::resource('proposal-exams', ProposalExamsController::class);

use App\Http\Controllers\StudentActivityUnitsController;

Route::resource('student_activity_units', StudentActivityUnitsController::class);

use App\Http\Controllers\StudentInfosController;

Route::resource('student-infos', StudentInfosController::class);

use App\Http\Controllers\SemesterController;

Route::resource('semesters', SemesterController::class);

use App\Http\Controllers\AdmissionController;

Route::resource('admissions', AdmissionController::class);

use App\Http\Controllers\LecturerController;

Route::resource('lecturers', LecturerController::class);


Route::get('/', function () {
    return view('welcome');
});
