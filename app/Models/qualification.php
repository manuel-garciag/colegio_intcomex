<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Qualification
 *
 * @property $id
 * @property $teacher_users_id
 * @property $student_users_id
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property StudentSubject $studentSubject
 * @property TeacherSubject $teacherSubject
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Qualification extends Model
{
    
    static $rules = [
        'nota' => 'required',
		'teacher_users_id' => 'required',
		'student_users_id' => 'required',
		'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nota', 'teacher_users_id','student_users_id','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function studentSubject()
    {
        return $this->hasOne('App\Models\StudentSubject', 'id', 'student_users_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teacherSubject()
    {
        return $this->hasOne('App\Models\TeacherSubject', 'id', 'teacher_users_id');
    }
    
    /**
     * Validamos que tanto el estudiante como el docente se encuentren conectados en la misma materia
     */
    public static function valUserTeacher(Array $data = [])
    {
        $student = $data['student'];
        $teacher = $data['teacher'];

        $result = array();
        $result['status'] = false;
        $result['data'] = [];

        if (!empty($student) && !empty($teacher) ) {
            $validation = DB::table('subjects as s')
            ->join('student_subjects as ss', 'ss.subjects_id', '=', 's.id')
            ->join('teacher_subjects as ts', 'ts.subjects_id', '=', 's.id')
            ->where('ss.users_id', $student)
            ->where('ts.users_id', $teacher)
            ->select(
                's.id as subject_id',
                'ss.users_id as student_id',
                'ts.users_id as teacher_id'
            )
            ->get();

            if (count($validation)) {
                $result['status'] = true;
                $result['data'] = $validation;
            }

        }

        return $result;

    }

    /**
     * Desactivamos las notas que esten activas entre el estudiante y el docente
     */
    public static function disabledQualifications(Int $student = null, Int $teacher = null)
    {
        $result = array();
        $result['status'] = false;
        $result['data'] = [];

        if (!empty($student) && !empty($teacher)) {
            $disabled =  DB::table('qualifications')
            ->where('student_users_id', $student)
            ->where('teacher_users_id', $teacher)
            ->where('status', 1)
            ->update(['status' => 0]);

            // if ($disabled) {
                $result['status'] = true;
            // }

        }

        // return $disabled;
        return $result;
    }

}
