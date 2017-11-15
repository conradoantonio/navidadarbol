<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Producto;
use App\Categoria;
use App\TipoArmado;
use App\TipoPataSoporte;
use App\ProductoMedidas;
use Image;
use Input;

class ProductosController extends Controller
{
    /**
     *==========================================================================================================================================================
     *=                                                  Empiezan las funciones relacionadas a los productos                                                   =
     *==========================================================================================================================================================
     */

    /**
     * Carga la vista de productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->check()) {
            $title = "Productos";
            $menu = "Productos";
            $categorias = Categoria::all();
            $armados = TipoArmado::all();
            $patas_soportes = TipoPataSoporte::all();
            $productos = Producto::producto_detalles();

            if ($request->ajax()) {
                return view('productos.table_categorias', ['categorias' => $categorias]);
            }
            return view('productos.productos', ['productos' => $productos, 'categorias' => $categorias, 'armados' => $armados, 'patas_soportes' => $patas_soportes, 'menu' => $menu, 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Carga la tabla de productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_table(Request $request)
    {
        $productos = Producto::producto_detalles();
        if ($request->ajax()) {
            return view('productos.table_productos', ['productos' => $productos]);
        }
    }

    /**
     * Guarda un producto nuevo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return redirect /productos
     */    
    public function guardar_producto(Request $request)
    {
        $producto = new Producto;
        
        $producto->categoria_id = $request->categoria_id;
        $producto->altura = $request->altura;
        $producto->puntas = $request->puntas;
        $producto->ancho = $request->ancho;
        $producto->peso_empaque = $request->peso_empaque;
        $producto->dimensiones_empaque = $request->dimensiones_empaque;
        $producto->armado_id = $request->armado_id;
        $producto->secciones = $request->secciones;
        $producto->pata_soporte_id = $request->pata_soporte_id;
        $producto->precio = $request->precio;
        $producto->agotado = $request->agotado ? 1 : 0;
        $producto->status = 1;

        $producto->save();

        //return back();
    }

    /**
     * Edita un producto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return redirect /productos
     */
    public function editar_producto(Request $request)
    {
        $producto = Producto::find($request->id);
        
        if ($producto) {
            
            $producto->categoria_id = $request->categoria_id;
            $producto->altura = $request->altura;
            $producto->puntas = $request->puntas;
            $producto->ancho = $request->ancho;
            $producto->peso_empaque = $request->peso_empaque;
            $producto->dimensiones_empaque = $request->dimensiones_empaque;
            $producto->armado_id = $request->armado_id;
            $producto->secciones = $request->secciones;
            $producto->pata_soporte_id = $request->pata_soporte_id;
            $producto->precio = $request->precio;
            $producto->agotado = $request->agotado ? 1 : 0;

            $producto->save();
        }
        //return back();
    }

    /**
     * Elimina un producto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return ["success" => true]
     */
    public function eliminar_producto(Request $request)
    {
        try {
            $producto = Producto::find($request->id);
            $producto->delete();
            return ["success" => true];
        } catch(\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Elimina múltiples productos a la vez.
     *
     * @param  \Illuminate\Http\Request $request
     * @return ["success" => true]
     */
    public function eliminar_multiples_productos(Request $request)
    {
        try {
            DB::table('productos')
            ->whereIn('id', $request->checking)
            ->delete();
            return ["success" => true];
        } catch(\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     *==========================================================================================================================================================
     *=                                        Empiezan las funciones relacionadas a las categorías (tipos) de producto                                        =
     *==========================================================================================================================================================
     */

    /**
     * Guarda una nueva categoria de producto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\TipoProducto
     */    
    public function guardar_tipo_producto(Request $request)
    {
        $categoria = new Categoria;

        $categoria->categoria = $request->tipo_producto;
        $categoria->costo_envio = $request->costo_envio ? '1' : '0';
        $categoria->monto_minimo_envio = $request->monto_minimo_envio;
        $categoria->tarifa_envio = $request->tarifa_envio;

        $name = "img/default.jpg";
        $foto = $request->file('imagen_categoria');
        if ($foto) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension_archivo = $foto->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/categorias/'.time().'.'.$extension_archivo;
                $foto = Image::make($foto)
                //->resize(600, 1000)
                ->save($name);
                $categoria->foto = $name;
            }
        }

        $categoria->save();

        return Categoria::all();
    }

    /**
     * Edita una categoria de producto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return App\TipoProducto
     */    
    public function editar_tipo_producto(Request $request)
    {
        $categoria = Categoria::find($request->tipo_producto_id);

        if ($categoria) {
            $categoria->categoria = $request->tipo_producto;
            $categoria->costo_envio = $request->costo_envio ? '1' : '0';
            $categoria->monto_minimo_envio = $request->monto_minimo_envio;
            $categoria->tarifa_envio = $request->tarifa_envio;

            $name = "img/default.jpg";
            $foto = $request->file('imagen_categoria');
            if ($foto) {
                $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
                $extension_archivo = $foto->getClientOriginalExtension();
                if (array_search($extension_archivo, $extensiones_permitidas)) {
                    $name = 'img/categorias/'.time().'.'.$extension_archivo;
                    $foto = Image::make($foto)
                    //->resize(600, 1000)
                    ->save($name);
                    $categoria->foto = $name;
                }
            }

            $categoria->save();
        }
        return Categoria::all();
    }

    /**
     * Elimina una categoria de producto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return App\TipoProducto
     */    
    public function eliminar_tipo_producto(Request $request)
    {
        $categoria = Categoria::find($request->tipo_producto_id);

        if ($categoria) {
            $categoria->delete();
        }
        return Categoria::all();
    }
}
