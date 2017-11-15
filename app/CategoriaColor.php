<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaColor extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'categoria_colores';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['categoria_id', 'color_id'];
}
