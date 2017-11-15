<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'categorias';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['categoria', 'costo_envio', 'monto_minimo_envio', 'tarifa_envio', 'foto', 'created_at'];

    /**
     * Retorna las categorías con los colores asigados.
     */
    public static function categoria_colores($categoria_id = false)
    {
        $categorias = $categoria_id ? Categoria::where('id', $categoria_id)->get() : Categoria::all();
        foreach ($categorias as $categoria) {
            $categoria->array_colores = CategoriaColor::where('categoria_id', $categoria->id)->lists('color_id');
        }

        return $categorias;
    }

    /**
     * Retorna las categorías con las fotos de ésta.
     */
    public static function categoria_fotos($categoria_id = false)
    {
        $categorias = $categoria_id ? Categoria::where('id', $categoria_id)->get() : Categoria::all();
        foreach ($categorias as $categoria) {
            $categoria->fotos = CategoriaFoto::where('categoria_id', $categoria->id)->get();
        }

        return $categorias;
    }
}
