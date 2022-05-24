<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    static $rules = [
		'name' => 'required',
		'email' => 'required',
		'rols_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'rol_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rol()
    {
        return $this->hasOne('App\Models\Rol', 'id', 'rols_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studentSubjects()
    {
        return $this->hasMany('App\Models\StudentSubject', 'users_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teacherSubjects()
    {
        return $this->hasMany('App\Models\TeacherSubject', 'users_id', 'id');
    }

    public static function listUsers($rol_id = 0){
        $result = array();
        $result['status'] = false;
        $result['data'] = [];

        if (!empty($rol_id)) {
            $users = DB::table('users')
            ->where('rols_id', $rol_id)
            ->join('rols', 'users.rols_id', '=', 'rols.id')
            ->select('users.id', 'users.name', 'users.email', 'rols.name as rol_name', 'rols.id as rol_id')
            ->get();

            $result['status'] = true;
            $result['data'] = [$users];
        };

        return  $result;
    }

    public static function getUser($id)
    {
        $result = array();
        $result['status'] = false;
        $result['data'] = [];

        if (!empty($id)) {
            $users = DB::table('users as u')
            ->where('u.id', $id)
            ->where('u.status', 1)
            ->where('r.status', 1)
            ->join('rols as r', 'u.rols_id', '=', 'r.id')
            ->select('u.*', 'r.id as rol_id', 'r.name as rol_nombre')
            ->get();

            if ($users[0]->rol_id == 3) { //Por defecto el rol 3 es de estudiante              

                $qualifications = DB::table('qualifications as q')
                ->where('q.student_users_id', $id)
                ->where('q.status',1)
                ->orderBy('q.created_at', 'asc')
                ->groupBy('q.teacher_users_id')
                ->select('q.teacher_users_id as teacher', DB::raw('group_concat(q.nota) as qualifications'))
                ->get();

                $users[0]->qualifications = $qualifications;
            }

            $result['status'] = true;
            $result['data'] = [$users];
        };

        return  $result;
    }

}
