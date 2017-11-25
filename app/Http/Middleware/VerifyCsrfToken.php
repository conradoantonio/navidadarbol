<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/check_order',//Webhook
        //Principio de los de conekta prueba
        '/post_send',
        '/cargar/codigo_postal',
        '/crear_cliente',
        '/app/validar_cargo',
        'app/guardar_paypal_cargo',
        '/procesar_orden',
        '/app/orden_empresa',
/*        '/pedidos/obtener_info_pedido',*/
        //Fin de los de conekta prueba
        '/productos/cargar_subcategorias',
        '/subir_imagenes',
        '/app/registro_usuario',
        '/app/login',
        '/app/usuario/cargar_imagen',
        '/app/actualizar_usuario',
        '/app/recuperar_contra',
        '/app/actualizar_foto',
        '/app/agregar_direccion',
        '/app/actualizar_direccion',
        '/app/eliminar_direccion',
        '/app/listar_direcciones',
        '/app/productos_categoria',
        '/app/preguntas_frecuentes',
        '/app/verificar_codigo_postal',
        '/app/obtener_pedidos_usuario',
        '/app/info_empresas/costo_envios',
        '/app/generar_cotizacion',
        '/app/obtener_cotizaciones_usuario',
        '/app/enviar_correo_detalle_orden',
        '/app/enviar_correo_detalle_cotizacion',
        '/app/calificar_servicio',
        '/app/agregar_favorito',
        '/app/remover_favorito',
        '/app/actualizar_player_id',
        '/app/test',
    ];
}
