<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaFoto extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'categoria_fotos';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['categoria_id', 'foto', 'color_id'];
}
