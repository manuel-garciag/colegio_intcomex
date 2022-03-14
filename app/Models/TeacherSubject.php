<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * Class TeacherSubject
 *
 * @property $id
 * @property $users_id
 * @property $subjects_id
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Qualification[] $qualifications
 * @property Subject $subject
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TeacherSubject extends Model
{
    
    static $rules = [
		'users_id' => 'required',
		'subjects_id' => 'required',
		'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id','subjects_id','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function qualifications()
    {
        return $this->hasMany('App\Models\Qualification', 'teacher_users_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subject()
    {
        return $this->hasOne('App\Models\Subject', 'id', 'subjects_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'users_id');
    }

    /**
     * Lista de los estudiantes que tiene un docente
     * @param int $id
     * @return $result
     */
    public static function  listUsers($id = 0){
        $result = array();
        $result['status'] = false;
        $result['data'] = [];

        // select 
        // u.id,
        // u.name,
        // s.name,
        // (select GROUP_CONCAT(q.nota, '-') from qualifications q where q.student_users_id = ss.users_id ) notas
        // from student_subjects ss 
        // join users u on u.id = ss.users_id 
        // join teacher_subjects ts on ts.subjects_id = ss.subjects_id
        // join subjects s on s.id = ss.subjects_id 
        // where u.status = 1
        // and ts.users_id = $id

        if (!empty($id)) {
            $users = DB::table('student_subjects AS ss')
            ->where('u.status', 1)
            ->where('ts.users_id', $id)
            ->join('users AS u', 'u.id', '=', 'ss.users_id')
            ->join('rols AS r', 'r.id', '=', 'u.rols_id')
            ->join('teacher_subjects AS ts', 'ts.subjects_id', '=', 'ss.subjects_id')
            ->join('subjects AS s', 's.id', '=', 'ss.subjects_id')
            ->select('u.id AS id', 'u.name AS name', 'u.email AS email', 'r.name AS rol_name', 'r.id AS rol_id', 's.name AS s_name')
            ->get();

            $result['status'] = true;
            $result['data'] = [$users];
        };

        return $result;
    }

}
