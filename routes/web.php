<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\StudentGradeController;
//teacher
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EvaluationResultController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TeacherGradeController;
use App\Http\Controllers\Admin\GraficasController;
use App\Http\Controllers\Auth\ForgotPasswordController;


/*
|--------------------------------------------------------------------------
| PÁGINAS PÚBLICAS
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'));
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| PERFIL
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| DASHBOARDS POR ROL
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', RoleMiddleware::class . ':teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
});

Route::middleware(['auth', RoleMiddleware::class . ':student'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
});

/*
|--------------------------------------------------------------------------
| RUTAS ADMIN (Usuarios, Grados, Notas)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {

    // CRUD de usuarios y grados
    Route::resource('users', UserController::class);
    Route::resource('grades', GradeController::class);

    // Ver estudiantes de un grado
    Route::get('grades/{grade}/students', [GradeController::class, 'showStudents'])->name('grades.students');

    // Asignar estudiante a un grado
    Route::post('grades/{grade}/assign-student', [GradeController::class, 'assignStudent'])->name('grades.assignStudent');

    // CRUD de notas de estudiantes con nombres corregidos (snake_case)
// Resource sin create ni store
    Route::resource('student-grades', StudentGradeController::class)
         ->except(['create', 'store'])
         ->names([
            'index'   => 'student_grades.index',
            'edit'    => 'student_grades.edit',
            'update'  => 'student_grades.update',
            'destroy' => 'student_grades.destroy',
         ]);

    // Rutas personalizadas para create y store con gradeId
    Route::get('student-grades/create/{gradeId}', [StudentGradeController::class, 'create'])
         ->name('student_grades.create');

    Route::post('student-grades/store/{gradeId}', [StudentGradeController::class, 'store'])
         ->name('student_grades.store');
     // Graficas
    Route::get('graficas', [GraficasController::class, 'index'])->name('graficas.index');
});

/*
|--------------------------------------------------------------------------
| RUTAS TEACHER (Grades, Materials, Evaluations, Results, Student Grades)
|--------------------------------------------------------------------------
*/
Route::prefix('teacher')
    ->name('teacher.')
    ->middleware(['auth', RoleMiddleware::class . ':teacher'])
    ->group(function() {

    /*
    |--------------------------------------------------------------------------
    | Gestión de grados y materiales
    |--------------------------------------------------------------------------
    */
    Route::get('grades', [MaterialController::class,'index'])->name('gestion_grades.index');
    Route::get('grades/{id}', [MaterialController::class,'show'])->name('gestion_grades.show');
    Route::post('grades/{id}/materials', [MaterialController::class,'store'])->name('gestion_grades.materials.store');

    /*
    |--------------------------------------------------------------------------
    | Gestión de evaluaciones
    |--------------------------------------------------------------------------
    */
    Route::get('evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');
    Route::get('evaluations/create', [EvaluationController::class, 'create'])->name('evaluations.create');
    Route::post('evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');
    Route::get('evaluations/{evaluation}/edit', [EvaluationController::class, 'edit'])->name('evaluations.edit');
    Route::put('evaluations/{evaluation}', [EvaluationController::class, 'update'])->name('evaluations.update');
    Route::delete('evaluations/{evaluation}', [EvaluationController::class, 'destroy'])->name('evaluations.destroy');

    /*
    |--------------------------------------------------------------------------
    | Resultados de evaluaciones
    |--------------------------------------------------------------------------
    */
    Route::get('evaluation-results', [EvaluationResultController::class, 'index'])->name('evaluation_results.index');
    Route::get('evaluation-results/create', [EvaluationResultController::class, 'create'])->name('evaluation_results.create');
    Route::post('evaluation-results', [EvaluationResultController::class, 'store'])->name('evaluation_results.store');
    Route::get('evaluation-results/{result}/edit', [EvaluationResultController::class, 'edit'])->name('evaluation_results.edit');
    Route::put('evaluation-results/{result}', [EvaluationResultController::class, 'update'])->name('evaluation_results.update');
    Route::delete('evaluation-results/{result}', [EvaluationResultController::class, 'destroy'])->name('evaluation_results.destroy');

    /*
    |--------------------------------------------------------------------------
    | Gestión de notas (Student Grades)
    |--------------------------------------------------------------------------
    */
    Route::get('student-grades', [TeacherGradeController::class, 'index'])->name('student_grades.index');
    Route::get('student-grades/create', [TeacherGradeController::class, 'create'])->name('student_grades.create');
    Route::post('student-grades', [TeacherGradeController::class, 'store'])->name('student_grades.store');
    Route::get('student-grades/{studentGrade}/edit', [TeacherGradeController::class, 'edit'])->name('student_grades.edit');
    Route::put('student-grades/{studentGrade}', [TeacherGradeController::class, 'update'])->name('student_grades.update');
    Route::delete('student-grades/{studentGrade}', [TeacherGradeController::class, 'destroy'])->name('student_grades.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
