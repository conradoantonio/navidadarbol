<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPataSoporte extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'tipo_pata_soporte';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['pata_soporte'];
}
