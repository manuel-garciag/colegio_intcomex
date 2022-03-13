<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    

}
