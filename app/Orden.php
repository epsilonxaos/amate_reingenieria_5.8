<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'orden';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'evento_id',
        'cupon_id',
        'folio',
        'nombre_completo',
        // 'nombre',
        // 'apllido_p',
        // 'apllido_m',
        'correo',
        'telefono',
        'personas',
        'precio',
        'descuento',
        'pago_metodo',
        'pago_realizado',
        'pago_referencia',
        'status',
    ];
}
