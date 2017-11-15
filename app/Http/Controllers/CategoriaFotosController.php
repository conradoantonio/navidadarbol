<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Image;
use App\Color;
use App\Categoria;
use App\CategoriaFoto;
use App\CategoriaColor;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriaFotosController extends Controller
{
    /**
     *=========================================================================================================================================================================
     *=                                               Empiezan las funciones relacionadas al módulo de asignar colores categoría                                              =
     *=========================================================================================================================================================================
     */
    /**
     * Carga la vista de productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->check()) {
            $menu = $title = "Asigar colores categoría";
            $categorias = Categoria::categoria_colores();
            $colores = Color::where('status', 1)->get();
            if ($request->ajax()) {
                return view('categorias.table', ['categorias' => $categorias]);
            }
            return view('categorias.categorias', ['categorias' => $categorias, 'colores' => $colores, 'menu' => $menu, 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Actualiza los colores de una categoría.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return $fotos
     */
    public function actualizar_colores_categoria(Request $request)
    {
        $cat_id = $request->categoria_id;
        $array_colores = $request->array_colores;
        
        CategoriaFoto::where('categoria_id', $cat_id)->whereNotIn('color_id', $array_colores)->delete();

        CategoriaColor::where('categoria_id', $cat_id)->delete();

        if ($array_colores) {
            foreach ($array_colores as $color_id) {
                $categoria_color = New CategoriaColor;
                $categoria_color->categoria_id = $cat_id;
                $categoria_color->color_id = $color_id;
                $categoria_color->save();
            }
            return ['msg' => 'Colors saved!'];
        }

        return ['msg' => "There wasn't colors to saved!"];
    }

    /**
     * Elimina un color de una categoría.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array()
     */
    public function eliminar_color_categoria(Request $request)
    {
        $color = CategoriaColor::find($request->categoria_color_id);

        if ($color) {
            $color->delete();
            $colores = Categoria::categoria_colores($request->categoria_id);
            CategoriaFoto::where('categoria_id', $request->categoria_id)->where('color_id', $color->color_id)->delete();
            return ['msg' => 'Deleted!', 'colores' => $colores];
        }
    }

    /**
     * Lista los colores de una categoría.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return view categorias.galeria
     */
    public function listar_colores_categoria(Request $request)
    {
        $colores = CategoriaColor::select(DB::raw('categoria_colores.id AS categoria_color_id, colores.color, colores.foto, categorias.id AS categoria_id, categorias.categoria'))
        ->leftJoin('categorias', 'categoria_colores.categoria_id', '=', 'categorias.id')
        ->leftJoin('colores', 'categoria_colores.color_id', '=', 'colores.id')
        ->where('categoria_colores.categoria_id', $request->categoria_id)
        ->where('colores.status', 1)
        ->get();

        return view('categorias.galeria', ['colores' => $colores]);
    }

    /**
     *=========================================================================================================================================================================
     *=                                               Empiezan las funciones relacionadas al módulo de asignar fotos categoría                                                =
     *=========================================================================================================================================================================
     */

    /**
     * Carga la vista de colores.
     *
     * @return \Illuminate\Http\Response
     */
    public function fotos(Request $request)
    {
        if (auth()->check()) {
            $menu = $title = "Asigar fotos categoría";
            $categorias = Categoria::categoria_fotos();
            $colores = Color::where('status', 1)->get();

            if ($request->ajax()) {
                return view('fotos.table', ['colores' => $colores]);
            }
            return view('fotos.fotos', ['categorias' => $categorias, 'colores' => $colores, 'menu' => $menu, 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Carga los colores disponibles de una categoría.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoria_colores(Request $request)
    {
        return Color::categoria_colores($request->categoria_id, $request->color_id);
    }

    /**
     * Devuelve la vista de galería de fotos de la categoría
     *
     * @param  \Illuminate\Http\Request  $request
     * @return view fotos.galeria
     */
    public function categoria_galeria_fotos(Request $request)
    {
        $colores = CategoriaFoto::select(DB::raw('categoria_fotos.id AS categoria_foto_id, colores.id AS color_id, colores.color, categoria_fotos.foto, categorias.id AS categoria_id, categorias.categoria'))
        ->leftJoin('categorias', 'categoria_fotos.categoria_id', '=', 'categorias.id')
        ->leftJoin('colores', 'categoria_fotos.color_id', '=', 'colores.id')
        ->where('categoria_fotos.categoria_id', $request->categoria_id)
        ->where('colores.status', 1)
        ->get();

        return view('fotos.galeria', ['colores' => $colores]);
    }

    /**
     * Agrega una nueva foto a una categoría
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array()
     */
    public function agregar_foto_categoria(Request $request)
    {
        $foto_categoria = new CategoriaFoto;
        $foto_categoria->categoria_id = $request->categoria_id;
        $foto_categoria->color_id = $request->color_id;

        $name = "img/default.jpg";
        $foto = $request->file('foto');
        if ($foto) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension_archivo = $foto->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/foto_categoria/'.time().'.'.$extension_archivo;
                $foto = Image::make($foto)
                ->resize(600, 1000)
                ->save($name);
                $foto_categoria->foto = $name;
            }
        }
   
        $foto_categoria->save();
        return ['msg' => 'Saved!'];
    }

    /**
     * Edita una foto de una categoría
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array()
     */
    public function editar_foto_categoria(Request $request)
    {
        $foto_categoria = CategoriaFoto::find($request->id);
        if ($foto_categoria) {
            $foto_categoria->categoria_id = $request->categoria_id;
            $foto_categoria->color_id = $request->color_id;

            $name = "img/default.jpg";
            $foto = $request->file('foto');
            if ($foto) {
                $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
                $extension_archivo = $foto->getClientOriginalExtension();
                if (array_search($extension_archivo, $extensiones_permitidas)) {
                    $name = 'img/foto_categoria/'.time().'.'.$extension_archivo;
                    $foto = Image::make($foto)
                    ->resize(600, 1000)
                    ->save($name);
                    $foto_categoria->foto = $name;
                }
            }
            $foto_categoria->save();
            return ['msg' => 'Saved!'];
        }
    }

    /**
     * Elimina una foto de una categoría
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array()
     */
    public function eliminar_foto_categoria(Request $request)
    {
        $foto_categoria = CategoriaFoto::find($request->categoria_foto_id);
        if ($foto_categoria) {
            $foto_categoria->delete();
            return ['msg' => 'Deleted!'];
        }
        return ['msg' => 'This is not a valid id photo to delete!'];
    }

    /**
     *=========================================================================================================================================================================
     *=                                                   Empiezan las funciones relacionadas al módulo de cargado de colores                                                 =
     *=========================================================================================================================================================================
     */

    /**
     * Carga la vista de colores.
     *
     * @return \Illuminate\Http\Response
     */
    public function colores(Request $request)
    {
        if (auth()->check()) {
            $menu = $title = "Colores";
            $colores = Color::all();

            if ($request->ajax()) {
                return view('colores.table', ['colores' => $colores]);
            }
            return view('colores.colores', ['colores' => $colores, 'menu' => $menu, 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Añade un color.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array()
     */
    public function subir_color(Request $request)
    {
        $color = New Color;

        $color->color = $request->color;

        $name = "img/colores/default.jpg";//Solo permanecerá con ese nombre cuando NO se seleccione una imágen como tal.
        $foto = $request->file('foto');
        if ($foto) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension_archivo = $foto->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/colores/'.time().'.'.$extension_archivo;
                $foto = Image::make($foto)
                ->resize(300, 300)
                ->save($name);
                $color->foto = $name;
            }
        }

        $color->save();
        return ['msg' => 'Saved!'];
    }

    /**
     * Edita un color.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array()
     */
    public function editar_color(Request $request)
    {
        $color = Color::find($request->id);

        if ($color) {
            $color->color = $request->color;

            $name = "img/colores/default.jpg";//Solo permanecerá con ese nombre cuando NO se seleccione una imágen como tal.
            $foto = $request->file('foto');
            if ($foto) {
                $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
                $extension_archivo = $foto->getClientOriginalExtension();

                if (array_search($extension_archivo, $extensiones_permitidas)) {
                    //$name = 'img/colores/'.$foto->getClientOriginalName();
                    $name = 'img/colores/'.time().'.'.$extension_archivo;
                    $foto = Image::make($foto)
                    ->resize(300, 300)
                    ->save($name);
                    $color->foto = $name;
                }
            }
            $color->save();
            return ['msg' => 'Saved!'];
        }
    }

    /**
     * Elimina un color.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array()
     */
    public function eliminar_color(Request $request)
    {
        $color = Color::find($request->id);

        if ($color) {
            $color->delete();
            return ['msg' => 'Deleted!'];
        }

        return ['msg' => 'Color not found'];
    }
}
