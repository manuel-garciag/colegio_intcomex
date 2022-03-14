<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentSubjectController;
use App\Http\Controllers\TeacherSubjectController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Asociar docentes/estudiantes con las asignaturas
Route::post('/save-subject-user', function (Request $request)  {
    $rol = $request['rol'];
    $id = $request['id'];
    $subject = $request['subject'];

    $data = [
        'users_id' => $id,
		'subjects_id' => $subject,
		'status' => 1
    ];

    if ($rol == 2) {
        $objTeacher = new TeacherSubjectController();
        $result = $objTeacher->setSubjectsTeacher($data);
    }else if($rol == 3){
        $objStudent = new StudentSubjectController();
        $result = $objStudent->setSubjectsStudent($data);
    }

    return $result;
});

//Ruta para ver el listado de ñas asignaturas
Route::post('/subjects-list', function () {
    $objSubject = new SubjectController();
    $subject = $objSubject->listSubjects();
    return $subject;
});