<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Genero extends Model 
{

    protected $table = 'modelo_genero';
    protected $primaryKey = 'genero_id';
    
    protected $fillable = [
        'nombre',
    ];
    public $timestamps = false;
}
