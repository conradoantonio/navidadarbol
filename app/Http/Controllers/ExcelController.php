<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel, Input, File;
use DB;
use App\Usuario;
use App\Producto;
use App\Categoria;
use App\TipoArmado;
use App\TipoPataSoporte;

class ExcelController extends Controller
{   
    /**
     * Importa productos a través de un archivo de excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function importar_productos()
    {
        if (Input::hasFile('archivo-excel')) {
            //DB::setFetchMode(PDO::FETCH_ASSOC);
            //$nombres = DB::table('productos')->lists('nombre');//Arreglo que contiene los nombres de los productos existentes      
            //$nombre_array = array();//Arreglo que contendrá los códigos de los productos del EXCEL
            $path = Input::file('archivo-excel')->getRealPath();
            $extension = Input::file('archivo-excel')->getClientOriginalExtension();

            if ($extension == 'xlsx' || $extension == 'xls') {
                $data = Excel::load($path, function($reader) {
                    $reader->setDateFormat('Y-m-d');
                })->get();
                

                if (!empty($data) && $data->count()) {
                    foreach ($data as $key => $value) {

                        if ($value->categorias == null || $value->categorias == "")
                            continue;

                        $categoria_id = Categoria::where('categoria', $value->categorias)->first();
                        $armado_id = TipoArmado::where('armado', $value->armado)->first();
                        $pata_soporte_id = TipoPataSoporte::where('pata_soporte', $value->pata_soporte)->first();
                        $agotado =  strtolower($value->agotado) == 'si' ? 1 : 0;
                        $insert = [
                            'categoria_id' => $categoria_id ? $categoria_id->id : 0,
                            'altura' => str_replace(['*', 'm', 'M', 't', 's', '.'], '', $value->altura),
                            'puntas' => $value->puntas,
                            'ancho' => $value->ancho,
                            'peso_empaque' => $value->peso_de_empaque,
                            'dimensiones_empaque' => $value->dimensiones_de_empaque,
                            'armado_id' => $armado_id ? $armado_id->id : 0,
                            'secciones' => $value->secciones,
                            'pata_soporte_id' => $pata_soporte_id ? $pata_soporte_id->id : 0,
                            'precio' => $value->precio,
                            'agotado' => $agotado,
                            'status' => 1
                        ];

                        Producto::updateOrCreate([
                            'categoria_id' => $insert['categoria_id'],
                            'altura' => $insert['altura'],
                            'puntas' => $insert['puntas'],
                            'ancho' => $insert['ancho'],
                            'peso_empaque' => $insert['peso_empaque'],
                            'dimensiones_empaque' => $insert['dimensiones_empaque'],
                            'armado_id' => $insert['armado_id'],
                            'secciones' => $insert['secciones'],
                            'pata_soporte_id' => $insert['pata_soporte_id'],
                            'precio' => $insert['precio'],
                            'agotado' => $insert['agotado'],
                        ], $insert);
                    }
                }//End data count if
            }//End of extension if
        }//End first if
        $num_productos = Producto::where('status', 1)->count();
        return ['msg' => 'Uploaded!', 'num_productos' => $num_productos];
    }

    /**
     * Exporta productos a un archivo de excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportar_productos($fecha_inicio,$fecha_fin)
    {
        $matchThese = array();
        $fecha_inicio != "" && $fecha_inicio != 'false' ? $matchThese['productos.created_at'] = $fecha_inicio : '';
        $fecha_fin != "" && $fecha_fin != 'false' ? $matchThese['created_at'] = $fecha_fin : '';

        $productos = Producto::query()
        ->select(DB::raw("categorias.categoria AS 'categorías', altura, puntas, ancho, peso_empaque AS 'peso de empaque', dimensiones_empaque AS 'dimensiones de empaque', 
            tipo_armado.armado, secciones, tipo_pata_soporte.pata_soporte AS 'pata soporte', precio, IF(agotado = 1, 'si', 'no') AS agotado "))
        ->leftJoin('categorias', 'productos.categoria_id', '=', 'categorias.id')
        ->leftJoin('tipo_armado', 'productos.armado_id', '=', 'tipo_armado.id')
        ->leftJoin('tipo_pata_soporte', 'productos.pata_soporte_id', '=', 'tipo_pata_soporte.id')
        ->orderBy("categorias.categoria")
        ->where(function($q) use ($matchThese) {
            foreach($matchThese as $key => $value) {
                if ($key == "productos.created_at") { $q->where($key, '>=', $value); }
                elseif ($key == "created_at") { $q->where($key, '<=', $value); }
                else { $q->where($key, '=', $value); }
            }
        })
        ->get();

        Excel::create('Productos', function($excel) use($productos) {
            $excel->sheet('Hoja 1', function($sheet) use($productos) {
                $sheet->cells('A:J', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                
                $sheet->cells('A1:J1', function($cells) {
                    $cells->setFontWeight('bold');
                });

                $sheet->fromArray($productos);
            });
        })->export('xlsx');

        return ['msg'=>'Excel creado'];
    }

    public function exportar_usuarios_app()
    {
        $productos = Usuario::query()
        ->select(DB::raw("usuario.id, usuario.nombre, usuario.apellido, usuario.correo, usuario.created_at AS fechaRegistro, IF(usuario.status = 0, 'bloqueado', IF(usuario.status = 1, 'activo', IF(usuario.status = 2, 'pendiente', 'Unkonwn status'))) as status"))
        ->get();

        Excel::create('Usuarios aplicación', function($excel) use($productos) {
            $excel->sheet('Hoja 1', function($sheet) use($productos) {
                $sheet->cells('A:F', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                
                $sheet->cells('A1:F1', function($cells) {
                    $cells->setFontWeight('bold');
                });

                $sheet->fromArray($productos);
            });
        })->export('xlsx');

        return ['msg'=>'Excel creado'];
    }

    /**
     * Guarda los registros de códigos postales de un excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function importar_categorias(Request $req)
    {
        if (Input::hasFile('archivo-excel-categorias')) {
            $path = Input::file('archivo-excel-categorias')->getRealPath();
            $extension = Input::file('archivo-excel-categorias')->getClientOriginalExtension();
            if ($extension == 'xlsx' || $extension == 'xls') {
                $data = Excel::load($path, function($reader) {
                    $reader->setDateFormat('Y-m-d');
                })->get();

                if (!empty($data) && $data->count()) {
                    foreach ($data as $key => $value) {
                        if ($value->categoria == null || $value->categoria == "")
                            continue;

                        $envio = strtolower($value->envio) == 'si' ? '1' : '0';

                        $insert[] = [
                            'categoria' => $value->categoria,
                            'costo_envio' => $envio,
                            'monto_minimo_envio' => $value->monto_minimo_envio,
                            'tarifa_envio' => $value->tarifa_envio
                        ];
                    }
                    if (!empty($insert)) {
                        DB::table('categorias')->insert($insert);
                        //return ['msg' => 'Upload successful'];
                    }//End insert if
                }//End data count if
            }//End of extension if
        }//End first if
        else {
            //return ['msg' => 'There is not file to upload'];
        }
        return back();   
    }
}
