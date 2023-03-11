<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = "categorias";
    protected $primaryKey = "id";
    protected $fillable = [
        "cover",
        "cover_en",
        "title",
        "title_en",
        "description",
        "description_en",
        "seccion"
    ];
}
