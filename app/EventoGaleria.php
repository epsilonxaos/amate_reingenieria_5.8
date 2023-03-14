<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoGaleria extends Model
{
    protected $table = 'evento_galeria';
    protected $primaryKey = 'id';
    protected $fillable = [
        'evento_id',
        'img',
        'order'
    ];

    public $timestamps = false;
}
