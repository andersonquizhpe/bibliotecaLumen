<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'modelo_autor';
    protected $primaryKey = 'autor_id';
    protected $fillable = [
        'nombre','apellido','email'
    ];
    public $timestamps = false;
}
