<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Usuario;
use App\Servicio;
use App\Estilista;
use App\ServicioDetalle;
use DB;
use Mail;

require_once("conekta-php-master/lib/Conekta.php");
\Conekta\Conekta::setApiKey("key_2EhmxkUCovSBNvCcXyARog");
\Conekta\Conekta::setApiVersion("2.0.0");

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->check()) {
            $title = "Pedidos";
            $menu = "Pedidos";
            $pedidos = Servicio::pedidos_detalles();

            if ($request->ajax()) {
                return view('pedidos.table', ['pedidos' => $pedidos]);
            }

            return view('pedidos.pedidos', ['pedidos' => $pedidos, 'menu' => $menu, 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Obtiene la información de un pedido en específico y su número de guía en caso de que tenga uno.
     *
     * @return $pedidos
     */
    public function obtener_pedido_por_id(Request $request)
    {
        return Servicio::pedido_detalles($request->id);
    }

    /**
     * Asigna un número de guía a un pedido.
     *
     * @return json $msg
     */
    public function asignar_num_guia(Request $request)
    {
        $order_id = $request->order_id;
        $num_guia = $request->num_guia;
        $paqueteria = $request->paqueteria;

        $servicio = Servicio::where('id', $order_id)
        ->update(['num_guia' => $num_guia, 'paqueteria' => $paqueteria]);

        if ($servicio) {
            $servicio = Servicio::where('id', $order_id)->first();
            $player_id [] = Usuario::obtener_player_id($servicio->usuario_id);
            $titulo = '¡Número de guía asignado!';
            $mensaje = "Su pedido con el número $order_id se le ha asignado la guía con el número $num_guia con la paquetería $paqueteria, vaya al módulo de pedidos para consultar esta información.";
            $data = array('msg' => 'Número de guía asignado');
            app('App\Http\Controllers\dataAppController')->enviar_notificacion_individual($titulo, $mensaje, $data, $player_id);

            $to = $servicio->correo_cliente;
            $fecha = $servicio->datetime_formated;
            $monto = $servicio->costo_total / 100;
            $nombre_cliente = $servicio->nombre_cliente;

            $subject = "Papá Noel | ¡Número de guía asignado!";

            Mail::send('emails.guia_asignada', ['nombre_cliente' => $nombre_cliente, 'order_id' => $order_id, 'num_guia' => $num_guia, 'paqueteria' => $paqueteria, 'monto' => $monto, 'fecha' => $fecha], function ($message)  use ($to, $subject)
            {
                $message->to($to);
                $message->subject($subject);
            });

            return response(['msg' => 'Número de guía asignado correctamente', 'status' => 'ok'], 200);
        } else {
            return response(['msg' => 'El pedido no es válido para asignar un número de guía', 'status' => 'Not found'], 404);
        }
    }

    /**
     * Weebhook de conekta.
     *
     */
    public function webhook_conekta()
    {
        $body = @file_get_contents('php://input');
        $data = json_decode($body);
        http_response_code(200); // Return 200 OK

        $payment = $data->data->object->object;
        $type = $data->type;

        if ($data->data->object->object == "charge") {//Se verifica que sea un cargo.

            if ($type == 'charge.paid') {//Se verifica que sea un cargo pagado
                $order_id = $data->data->object->order_id;
                Servicio::where('conekta_order_id', $order_id)->update(['status' => 'paid']);
                $servicio = Servicio::where('conekta_order_id', $order_id)->first();
                
                if ($servicio) {
                    if ($servicio->tipo_orden == 'oxxo') {//Se manda la notificación por onesignal
                        $player_id [] = Usuario::obtener_player_id($servicio->usuario_id);
                        $titulo = '¡Pago por oxxo exitoso!';
                        $mensaje = "Gracias por pagar en tiempo y forma su pedido solicitado por OXXO pay. Pronto se le asignará un número de guía para que pueda recibir satisfactoriamente su pedido.";
                        $data = array('msg' => 'Pedido por OXXO pay pagado');
                        
                        app('App\Http\Controllers\dataAppController')->enviar_notificacion_individual($titulo, $mensaje, $data, $player_id);
                    }
                    
                    $to = $servicio->correo_cliente;
                    $monto = $servicio->costo_total / 100;
                    $nombre_cliente = $servicio->nombre_cliente;

                    $subject = "Papá Noel | Confirmación de pago";

                    Mail::send('emails.pago_confirmado', ['nombre_cliente' => $nombre_cliente, 'monto' => $monto], function ($message)  use ($to, $subject)
                    {
                        $message->to($to);
                        $message->subject($subject);
                    });

                    return response(['msg' => 'Notificado'], 200);
                }//If para verificar que exista una orden con dicho order_id
                return response(['msg' => 'Cargo pagado recibido'], 200);
            }//If para verificar status del pago
        }//If que verifica tipo de pago
    }
}
