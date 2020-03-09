<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{

    protected $table = 'modelo_libro';
    protected $primaryKey='libro_id';
    protected $fillable = [
        'titulo','fechaPublicacion','numeroPaginas','nombre_editorial','isbn','imagen','resumen'
    ];
    public $timestamps = false;
}
