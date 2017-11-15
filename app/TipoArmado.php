<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoArmado extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'tipo_armado';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['armado'];
}
