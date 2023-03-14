<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'evento';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cover',
        'title',
        'title_en',
        'short_description',
        'short_description_en',
        'content',
        'content_en',
        'img_lateral_1',
        'img_lateral_2',
        'img_lateral_3',
        'horario_fijo',
        'horario',
        'tiempo_espera',
        'status',
    ];
}
