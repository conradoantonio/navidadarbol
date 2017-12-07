<?php

namespace App\Console\Commands;

use DB;
use App\Servicio;
use App\Usuario;
use Illuminate\Console\Command;

class CheckOxxoOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckOxxoOrder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the status of an oxxo order from conekta.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set('America/Mexico_City');
        $this->actual_datetime = date('Y-m-d H:i:s');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pedidos = Servicio::where('tipo_orden', 'oxxo')->where('status', 'pending_payment')->get();
        if ($pedidos) {
            foreach ($pedidos as $pedido) {
                $fecha_actual = $this->actual_datetime;
                $fecha_pedido = $pedido->created_at;

                $difference_in_seconds = strtotime($fecha_actual) - strtotime($fecha_pedido);

                if ($difference_in_seconds >= 86400) {

                    $player_id [] = Usuario::obtener_player_id($pedido->usuario_id);
                    $titulo = '¡Pago por oxxo expirado!';
                    $mensaje = "Su pedido solicitado a pagar por OXXO Pay ha expirado, por lo que si desea obtener su pedido, tendrá que volverlo a solicitar a través de nuestra aplicación y realizar el pago en menos de 24 horas a partir de su solicitud.";
                    $data = array('msg' => 'Pedido expirado');
                    
                    app('App\Http\Controllers\dataAppController')->enviar_notificacion_individual($titulo, $mensaje, $data, $player_id);
                    
                    Servicio::where('id', $pedido->id)->update(['status' => 'expired']);
                    
                    return 'expiro';
                } else {
                    return 'sigue siendo valido';
                }
            }
        } else {
            return 'No hay pedidos que verificar';
        }
    }
}
