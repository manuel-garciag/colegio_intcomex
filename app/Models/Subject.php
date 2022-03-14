<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Subject
 *
 * @property $id
 * @property $name
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Subject extends Model
{
    
    static $rules = [
		'name' => 'required',
		'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','status'];

    /**
     * Lista de las asignaturas
     * @return $result
     */
    public static function listSubject(){
      $result = array();
      $result['status'] = false;
      $result['data'] = [];

          $users = DB::table('subjects')
          ->where('status', 1)
          ->select('id', 'name')
          ->get();

          $result['status'] = true;
          $result['data'] = [$users];

      return  $result;
  }

}
