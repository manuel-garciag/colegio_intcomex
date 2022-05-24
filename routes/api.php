<?php

use App\Http\Controllers\QualificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentSubjectController;
use App\Http\Controllers\TeacherSubjectController;
use App\Http\Controllers\UserController;


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

//Ruta para ver el listado de las asignaturas
Route::post('/subjects-list', function () {
    $objSubject = new SubjectController();
    $subject = $objSubject->listSubjects();
    return $subject;
});

//Ruta para ver la informacion de un Studiante en base al docente
Route::post('/get-info-student', function (Request $request)  {
    $student = $request['student'];
    $teacher = $request['teacher'];

    $data = [
        'student' => $student,
        'teacher' => $teacher
    ];

    $objStudent = new UserController();
    $result = $objStudent->getInfoStudent($data);

    return $result;
});

//Asociar docentes/estudiantes con las asignaturas
Route::post('/save-qualifications', function (Request $request)  {

    $student = $request['student'];
    $teacher = $request['teacher'];
    $qualifications = $request['qualifications'];

    $data = [
        'student' => $student,
		'teacher' => $teacher,
		'qualifications' => $qualifications
    ];

    $objQualification = new QualificationController;
    $result = $objQualification->saveQualifications($data);

    return $result;
});