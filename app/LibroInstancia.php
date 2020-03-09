<?php

namespace App;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class LibroInstancia extends Model
{
    protected $table = 'modelo_libroinstancia';
    //public $incrementing = false;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey='libroinstancia_id';
    protected $fillable = [
        'fecha_devolucion','estado'
    ];
    public $timestamps = false;
    
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(),str_replace("-","",Uuid::uuid4()->toString()) );
        });
    }

}
