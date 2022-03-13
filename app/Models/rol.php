<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class rol extends Model
{
    use HasFactory;

    /**
     * Buscamos un id por el nombre del rol siempre que este activo
     * @param string $rol 
     * @return array['status'] $result['status']
     * @return array['data'] $result['data']
     */
    public static function searchRolName($rol_name = '')
    {

        $result = array();
        $result['status'] = false;
        $result['data'] = [];

        if (!empty($rol_name)) {
            $id = DB::table('rols')->where('name', $rol_name)->where('status', 1)->get();

            $result['status'] = true;
            $result['data'] = ['id' => $id];
        };

        return  $result;
    }
}
