<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioDetalle extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'servicio_detalles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['servicio_id', 'nombre_producto', 'foto_producto', 'color_id', 'color', 'precio', 'cantidad', 
        'categoria', 'altura', 'puntas', 'ancho', 'peso_empaque', 'dimensiones_empaque', 'tipo_armado', 'secciones', 
        'tipo_pata_soporte', 'created_at'
    ];
}
