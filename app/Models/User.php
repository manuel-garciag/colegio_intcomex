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

}
