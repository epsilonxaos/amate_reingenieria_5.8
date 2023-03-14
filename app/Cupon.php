<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $table = 'cupon';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'tipo',
        'descuento',
        'fecha_inicio',
        'fecha_finalizacion',
        'limite_usos',
        'usos',
        'status'
    ];
}
