<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Color extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'colores';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['color', 'foto', 'status'];

    /**
     * Retorna los colores de una categoría
     */
    public static function categoria_colores($categoria_id, $color_id)
    {
        $array_colores_insert = CategoriaFoto::where('categoria_id', $categoria_id)->lists('color_id');
        $array_colores_edit = array_diff($array_colores_insert->toArray(), array($color_id));

        $query = CategoriaColor::select(DB::raw('categoria_id, colores.id, color'))
        ->leftJoin('colores', 'categoria_colores.color_id', '=', 'colores.id')
        ->where('categoria_id', $categoria_id)
        ->where('colores.status', 1);

        $query = $color_id == '0' ? $query->whereNotIn('colores.id', $array_colores_insert)->get() : $query->whereNotIn('colores.id', $array_colores_edit)->get();
        return $query;
    }
}
