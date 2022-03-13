<?php

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentSubjectController;
use App\Http\Controllers\TeacherSubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('subjects', SubjectController::class); //Rutas para las asignaturas
Route::resource('qualifications', QualificationController::class); //Rutas para las notas
Route::resource('settings', SettingController::class); //Rutas para los ajustes del aplicativo
Route::resource('student-subjects', StudentSubjectController::class); //Rutas para los estudiantes y sus asignaturas
Route::resource('teacher-subjects', TeacherSubjectController::class); //Rutas para los docentes y su asignatura
// Rutas para ver, crear, editar, eliminar un usuario.
Route::get('users/list/{rol}', function ($rol) {
    return  UserController::index($rol);
});
Route::resource('users', UserController::class); //Rutas para los usuarios registrados

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
