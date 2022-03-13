<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['teacher_users_id','student_users_id','status'];


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
    

}
