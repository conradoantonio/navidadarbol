<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    /**
     * Define el nombre de la tabla del modelo.
     */
    protected $table = 'favoritos';

    /**
     * Define el nombre de los campos que podrán ser alterados de la tabla del modelo.
     */
    protected $fillable = ['usuario_id', 'categoria_id'];
}
