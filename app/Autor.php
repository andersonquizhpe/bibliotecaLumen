<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{

    protected $table = 'modelo_autor';
    protected $primaryKey = 'autor_id';
    protected $fillable = [
        'nombre','apellido','email'
    ];
    public $timestamps = false;
}
