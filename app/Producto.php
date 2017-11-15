<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class producto extends Model
{
	/**
     * Define el nombre de la tabla del modelo.
     */
    protected $table = 'productos';

    /**
     * Define el nombre de los campos que podrán ser alterados de la tabla del modelo.
     */
    protected $fillable = ['categoria_id', 'altura', 'puntas', 'ancho', 'peso_empaque', 'dimensiones_empaque', 
        'armado_id', 'secciones', 'pata_soporte_id', 'precio', 'agotado', 'status'
    ];

    /**
     * Retorna los detalles de los productos o producto en caso de que solo se requiera ver los de uno solo.
     *
     * @var array
     */
    public static function producto_detalles($producto_id = false)
    {
    	$result = Producto::select(DB::raw('productos.*, categorias.categoria, tipo_armado.armado, tipo_pata_soporte.pata_soporte'))
    	->leftJoin('categorias', 'productos.categoria_id', '=', 'categorias.id')
    	->leftJoin('tipo_armado', 'productos.armado_id', '=', 'tipo_armado.id')
    	->leftJoin('tipo_pata_soporte', 'productos.pata_soporte_id', '=', 'tipo_pata_soporte.id');

        $result = $producto_id ? $result->where('productos.id', $producto_id)->first() : $result->get();
    	return $result;
    }
}
