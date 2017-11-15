<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Servicio extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'servicios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id', 'nombre_cliente', 'correo_cliente', 'paypal_order_id', 'conekta_order_id', 'customer_id_conekta', 'costo_total', 'costo_envio', 
        'telefono', 'recibidor', 'calle', 'entre', 'num_ext', 'num_int', 'ciudad', 'estado', 'pais', 'codigo_postal', 'tipo_orden', 
        'last_digits', 'datetime_formated', 'num_referencia', 'num_guia', 'paqueteria', 'status', 'created_at'
    ];

    /**
     * Obtiene todos los pedidos pagados
     *
     * @return $pedidos
     */
    public static function pedidos_detalles()
    {
        $servicios = Servicio::select(DB::raw('servicios.*'))
        ->where('status', 'paid')
        ->get();

        foreach ($servicios as $servicio) {
            $servicio->detalles = ServicioDetalle::select(DB::raw('servicio_detalles.*, colores.foto'))
            ->leftJoin('colores', 'color_id', '=', 'colores.id')
            ->where('servicio_id', $servicio->id)
            ->get();
        }

        return $servicios;
    }

    /**
     * Obtiene todos los detalles de un pedido en específico.
     *
     * @return $pedidos
     */
    public static function pedido_detalles($id)
    {
        $servicio = Servicio::select(DB::raw('servicios.*'))
        ->where('status', 'paid')
        ->where('id', $id)
        ->first();

        $servicio->detalles = ServicioDetalle::select(DB::raw('servicio_detalles.*, colores.foto'))
        ->leftJoin('colores', 'color_id', '=', 'colores.id')
        ->where('servicio_id', $servicio->id)
        ->get();
            
        return $servicio;
    }
    
    /**
     *
     * @return Regresa el total de serviciosa
     */
    public static function total_servicios()
    {
        return Servicio::count();
    }

    /**
     *
     * @return Regresa el total de ventas filtrados por empresa
     */
    public static function total_vendido()
    {
        return Servicio::where('status', 'paid')
        ->sum(DB::raw('costo_total'));
    }

    /**
     *
     * @return Regresa el total de ventas semanales
     */
    public static function ventas_semanales()
    {
        return Servicio::select(DB::raw('SUBSTRING_INDEX(created_at, " ", 1) as created_at, SUM(costo_total)/100 AS "Costo_total", 
            MONTH(`created_at`) AS Mes, DAY(`created_at`) AS Dia, COUNT(*) AS Total_Ventas'))
        ->where('created_at', '>=', DB::raw('SUBDATE(CURDATE(),INTERVAL 7 DAY)'))
        ->where('created_at', '<', DB::raw('CURDATE()'))
        ->where('status', 'paid')
        ->groupBy(DB::raw('DAY(created_at)'))
        ->get();
    }

    /**
     *
     * @return Regresa el customer_id_conekta de un usuario
     */
    public static function obtener_id_conekta_usuario($usuario_id)
    {
        return Usuario::where('id', $usuario_id)->pluck('customer_id_conekta');
    }

    /**
     *
     * @return Regresa los pedidos realizados por un usuario
     */
    public static function obtener_pedidos_usuario($usuario_id)
    {
        return Servicio::where('usuario_id', $usuario_id)->orderBy('id', 'DESC')->get();
    }
}
