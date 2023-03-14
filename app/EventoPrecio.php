<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoPrecio extends Model
{
    protected $table = 'evento_precios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'evento_id',
        'personas',
        'precio'
    ];
}
