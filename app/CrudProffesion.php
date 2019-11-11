<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CrudProffesion extends Model
{
    protected $table = 'crudproffesion';

    protected $fillable = [
        'name', 'description', 'content', 'price'
    ];

    static function ShowCrud(){
        return DB::table('crudproffesion')
                    ->select('id', 'name', 'content', 'price')
                    ->orderBy('id')
                    ->get();
    }
}
