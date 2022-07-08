<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registros extends Model
{
    protected $table = 'registros';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'celular',
        'correo',
        'linea_fletera',
        'gps_vigente',
        'factura'
    ];
}
