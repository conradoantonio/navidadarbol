<?php

namespace App\Console\Commands;

use DB;
use App\Servicio;
use Illuminate\Console\Command;

//require_once("/home2/belyappc/public_html/navidad.belyapp.com/app/Http/Controllers/conekta-php-master/lib/Conekta.php");
require_once("/../../Http/Controllers/conekta-php-master/lib/Conekta.php");
\Conekta\Conekta::setApiKey("key_eRGsuxt67Lzciesx9XwjfQ");
\Conekta\Conekta::setApiVersion("2.0.0");

class CheckOxxoOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'conekta:CheckOxxoOrder';

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
        //return $pedidos;
        if ($pedidos) {
            foreach ($pedidos as $pedido) {
                $this->checkStatusOrder($pedido->id ,$pedido->conekta_order_id);
            }
        } else {
            return 'No hay pedidos que verificar';
        }
        
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function checkStatusOrder($id, $id_orden_conekta)
    {
        $orden_conekta = \Conekta\Order::find($id_orden_conekta);
        if ($orden_conekta->payment_status == 'paid') {//Se va a actualizar el pedido de oxxo ya que se encuentra pagado
            $pedido = Servicio::find($id);
            
            $pedido->status = 'paid';

            /*$num_referencia = $orden_conekta->charges[0]->payment_method->reference;
            $monto = $orden_conekta->amount/100 . $orden_conekta->currency;
            $to = $pedido->correo_cliente;
            $subject = "Confirmación de pago de oxxo";
            $msg = "<br><h3>Confirmación de pago de oxxo. </h3>".
                "<div><p>Se le notifica que su pago con el número de referencia $num_referencia por el monto $$monto ha sido registrado en nuestro sistema de forma exitosa</p></div>";
            $enviado = Mail::send([], [], function ($message) use($to, $subject, $msg) {
                $message->to($to)
                ->subject($subject)
                ->setBody($msg, 'text/html'); // for HTML rich messages
            });*/

            $pedido->save();
        }
    }
}
