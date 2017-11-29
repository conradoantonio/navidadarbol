<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Faq;
use App\Menu;
use App\Cupon;
use App\Pedidos;
use App\Usuario;
use App\Noticia;
use App\Favorito;
use App\Servicio;
use App\Producto;
use App\Estilista;
use App\Categoria;
use App\Subcategoria;
use App\TipoProducto;
use App\CodigoPostal;
use App\CategoriaFoto;
use App\PedidoDetalles;
use App\CuponHistorial;
use App\FotoPlaceholder;
use App\ServicioDetalle;
use App\UsuarioDireccion;
use Image;
use Mail;
use PDO;
use DB;

require_once("conekta-php-master/lib/Conekta.php");
\Conekta\Conekta::setApiKey("key_eRGsuxt67Lzciesx9XwjfQ");
\Conekta\Conekta::setApiVersion("2.0.0");

class dataAppController extends Controller
{
    function __construct() {
        date_default_timezone_set('America/Mexico_City');
        $this->actual_datetime = date('Y-m-d H:i:s');
        $this->app_id = "ca42c5c4-5e4e-499c-86f7-164bcb911b13";
        $this->app_key = "OWIyYThiZTQtMjI1Mi00OTQ5LWExMjktMDZjMWMwY2FjYTI0";
        $this->small_icon = "https://navidad.belyapp.com/img/small_icon.png";
        $this->regular_icon = "https://navidad.belyapp.com/img/regular_icon.png";
    }
    /**
     * Crea un nuevo usuario en caso de que el email proporcionado no se haya utilizado antes para un usuario.
     *
     * @param  Request $request
     * @return $usuario_app->id si es correcto el inicio de sesión o 0 si el email proporcionado se encuentra ya registrado.
     */
    public function registro_app(Request $request) 
    {
        if(count(Usuario::buscar_usuario_por_correo($request->correo))) {
            if ($request->red_social) {
                $usuario_app = Usuario::where('correo', $request->correo)
                ->first();
                
                $this->logs($usuario_app->id);

                return $usuario_app;
            }
            return 0;
        } else {
            $usuario_app = new Usuario;

            if (!$request->red_social) {
                $usuario_app->password = md5($request->password);
                $usuario_app->celular = $request->celular;
            } 
            $usuario_app->nombre = $request->nombre;
            $usuario_app->apellido = $request->apellido;
            $usuario_app->correo = $request->correo;
            $request->foto_perfil ? $usuario_app->foto_perfil = $request->foto_perfil : '';
            $usuario_app->red_social = $request->red_social;
            $usuario_app->player_id = $request->player_id;
            $usuario_app->status = 1;
            $usuario_app->created_at = $this->actual_datetime;

            $usuario_app->save();
            
            $this->logs($usuario_app->id);

            return Usuario::where('id', $usuario_app->id)
            ->first();
        }
    }

    /**
     * Valida que los datos de un login sean correctos en la aplicación y registra un log
     *
     * @param  Request  $request
     * @return $usuario si es correcto el inicio de sesión o 0 si los datos son incorrectos.
     */
    public function login_app(Request $request) 
    {
        DB::setFetchMode(PDO::FETCH_ASSOC);
        $usuario = Usuario::where('usuario.correo', '=', $request->correo)
        ->where('usuario.password', '=', md5($request->password))
        ->where('usuario.status', '=', 1)
        ->first();

        if (count($usuario) > 0) {
            $this->logs($usuario['id']);
            return $usuario;
        } else {
            return 0;
        }
    }

    /**
     * Actualiza todos los datos de un usuario a excepción de la foto de perfil, contraseña y correo.
     *
     * @param  Request  $request
     * @return $usuario_app
     */
    public function actualizar_datos_usuario(Request $request) 
    {
        $usuario_app = Usuario::find($request->id);

        if (count($usuario_app)) {
            $request->password ? $usuario_app->password = md5($request->password) : '';
            /*$usuario_app->nombre = $request->nombre;
            $usuario_app->apellido = $request->apellido;*/
            $request->celular ? $usuario_app->celular = $request->celular : '';

            $usuario_app->save();

            return $usuario_app;
        }

        return ['msg' => 'Sin actualizar'];
    }

    /**
     * Envía un correo con una nueva contraseña generada por el sistema al email proporcionado,
     * siempre y cuando este exista en la tabla de usuario.
     *
     * @param  string  $email
     * @return ['success'=>true] si el correo fue enviado exitosamente, ['success'=>false] si no se envió.
     */
    public function recuperar_contra(Request $request)
    {
        $correo = $request->correo;
        if (count(Usuario::buscar_usuario_por_correo($correo))) {
            $new_pass = str_random(7);
            Usuario::where('correo', $correo)
            ->update(['password' => md5($new_pass)]);

            $subject = "Papá Noel | Restablecimiento de contraseña";
            $to = $correo;

            Mail::send('emails.recuperar_usuario', ['contra' => $new_pass], function ($message)  use ($to, $subject)
            {
                $message->to($to);
                $message->subject($subject);
            });

            return ['msg' => 'Enviado'];
        }

        return ['msg' => 'Error al enviar correo'];
    }

    /**
     * Actualiza una foto de perfil de un usuario.
     *
     * @param  Request $request
     * @return $nombre_foto si la imagen fue subida exitosamente, 0 si hubo algún error subiendo la imagen.
     */
    public function actualizar_foto(Request $request)
    {
        $name = "img/default.jpg";
        $foto = $request->file('foto_usuario');
        if ($foto) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension_archivo = $foto->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/foto_usuario/'.time().'.'.$extension_archivo;
                $foto = Image::make($foto)
                //->resize(600, 1000)
                ->save($name);
                $usuario = Usuario::find($request->id);
                $usuario->foto_perfil = url().'/'.$name;
                $usuario->save();

                return url().'/'.$name;
            } else {
                return 0;
                //return ['msg' => 'Error, el archivo no tiene una extensión válida'];
            }
        } else {
            return 0;
            //return ['msg' => 'No se envió ninguna foto para actualizar'];
        }
    }

    /**
     * Agrega una dirección de envío para un usuario
     *
     * @param  Request  $request
     * @return $direccion
     */
    public function agregar_direccion_usuario_app(Request $request) 
    {
        $direccion = new UsuarioDireccion;

        $direccion->usuario_id = $request->usuario_id;
        $direccion->recibidor = $request->recibidor;
        $direccion->calle = $request->calle;
        $direccion->entre = $request->entre;
        $direccion->num_ext = $request->num_ext;
        $direccion->num_int = $request->num_int;
        $direccion->estado =  $request->estado;
        $direccion->ciudad = $request->ciudad;
        $direccion->pais = 'MX';
        $direccion->codigo_postal = $request->codigo_postal;
        $direccion->residencial = $request->residencial;
        $direccion->is_main = 0;

        $direccion->save();

        return $direccion;
    }

    /**
     * Actualizar una dirección de envío para un usuario
     *
     * @param  Request  $request
     * @return $direccion
     */
    public function actualizar_direccion_usuario_app(Request $request) 
    {
        $direccion = UsuarioDireccion::find($request->id);

        if (count($direccion)) {
            $direccion->recibidor = $request->recibidor;
            $direccion->calle = $request->calle;
            $direccion->entre = $request->entre;
            $direccion->num_ext = $request->num_ext;
            $direccion->num_int = $request->num_int;
            $direccion->estado =  $request->estado;
            $direccion->ciudad = $request->ciudad;
            $direccion->codigo_postal = $request->codigo_postal;
            $direccion->residencial = $request->residencial;

            $direccion->save();

            return $direccion;
        }

        return ['msg' => 'Error actualizando la dirección']; 
    }

    /**
     * Elimina una dirección de envío para un usuario
     *
     * @param  Request  $request
     * @return $direccion
     */
    public function eliminar_direccion_usuario_app(Request $request) 
    {
        $direccion = UsuarioDireccion::find($request->id);

        if (count($direccion)) {

            $direccion->delete();

            return ['msg' => 'Dirección eliminada correctamente'];
        }

        return ['msg' => 'Error eliminando la dirección'];
    }

    /**
     * Muestra una lista de todas las direcciones del usuario de la aplicación
     *
     * @param  Request  $request
     * @return $direcciones
     */
    public function listar_direcciones(Request $request) 
    {
        $direcciones = UsuarioDireccion::where('usuario_id', $request->usuario_id)
        ->get();

        if (count($direcciones)) {
            return $direcciones;
        }

        return ['msg' => 'El usuario no cuenta con direcciones.'];
    }

    /**
     * Marca una categoría como favorito por parte de un usuario
     *
     * @param  Request  $request
     * @return $favorito
     */
    public function agregar_favorito(Request $request) 
    {
        $favorito = new Favorito;

        $favorito->usuario_id = $request->usuario_id;
        $favorito->categoria_id = $request->categoria_id;

        $favorito->save();

        return $favorito;
    }

    /**
     * Remueve una categoría como favorito por parte de un usuario
     *
     * @param  Request  $request
     * @return \App\Favorito
     */
    public function remover_favorito(Request $request) 
    {
        return Favorito::where('usuario_id', $request->usuario_id)
        ->where('categoria_id', $request->categoria_id)
        ->delete();
    }

    /**
     * Regresa las noticias para mostrar en la aplicación.
     *
     * @return $noticias
     */
    public function mostrar_noticias() 
    {
        $noticias = Noticia::orderBy('created_at', 'DESC')->get();

        return $noticias;
    }

    /**
     * Regresa todos los productos enlistados por categoría.
     *
     * @return $productos
     */
    public function productos_categoria(Request $request)
    {
        if ($request->favorito) {
            $categorias = Favorito::select(DB::raw('categorias.id, categoria, IF(costo_envio = 0, "No", "Si") AS costo_envio, monto_minimo_envio, tarifa_envio, foto'))
            ->leftJoin('categorias', 'favoritos.categoria_id', '=', 'categorias.id')
            ->where('favoritos.usuario_id', $request->usuario_id)
            ->get();

        } else {
            $categorias = Categoria::select(DB::raw('categorias.id, categoria, IF(costo_envio = 0, "No", "Si") AS costo_envio, monto_minimo_envio, tarifa_envio, foto'))
            ->orderBy('categoria', 'ASC')
            ->get();
        }

        foreach ($categorias as $key => $cat) {
            $cat->productos = Producto::select(DB::raw('productos.id, categorias.categoria, altura, puntas, ancho, peso_empaque, dimensiones_empaque, secciones, precio, agotado, tipo_armado.armado, tipo_pata_soporte.pata_soporte'))
            ->leftJoin('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->leftJoin('tipo_armado', 'productos.armado_id', '=', 'tipo_armado.id')
            ->leftJoin('tipo_pata_soporte', 'productos.pata_soporte_id', '=', 'tipo_pata_soporte.id')
            ->where('categoria_id', $cat->id)
            ->where('status', 1)
            ->get();

            $cat->fotos = CategoriaFoto::select(DB::raw('categoria_fotos.id AS foto_id, categoria_fotos.foto AS foto_producto, colores.id AS colores_id, colores.color, colores.foto AS foto_color'))
            ->leftJoin('categorias', 'categoria_fotos.categoria_id', '=', 'categorias.id')
            ->leftJoin('colores', 'categoria_fotos.color_id', '=', 'colores.id')
            ->where('categoria_id', $cat->id)
            ->get();

            $favorito = Favorito::where('usuario_id', $request->usuario_id)->where('categoria_id', $cat->id)->first();
            $cat->favorito = $favorito ? 1 : 0;
        }
        return $categorias;
    }

    /**
     * Registra un nuevo inicio de sesión de la aplicación.
     *
     * @param  $id_usuario
     */
    public function logs($id_usuario) {
        DB::table('registro_logs')->insert([
            'user_id' => $id_usuario,
            'fechaLogin' => DB::raw('CURDATE()'),
            'realTime' => DB::raw('NOW()')
        ]);
    }

    /**
     *===================================================================================================================================
     *=                                     Empiezan las funciones relacionadas a la api de conekta                                     =
     *===================================================================================================================================
     */
    
    /**
     * Genera un token
     *
     * @param  Request $request
     * @return $nombre_foto si la imagen fue subida exitosamente, 0 si hubo algún error subiendo la imagen.
     */
    public function generar_token(Request $request)
    {
        return $request->conektaTokenId;
    }

    /**
     * Carga el formulario de prueba para conekta.
     *
     * @param  Request $request
     * @return $nombre_foto si la imagen fue subida exitosamente, 0 si hubo algún error subiendo la imagen.
     */
    public function cargar_form_conekta()
    {
        $title = $menu = 'Pedidos';
        return view('pruebas_conekta.form_prueba', ['menu' => $menu, 'title' => $title]);
    }

    /**
     * Busca si existe un usuario con un customer_id_conekta en la base de datos, si lo encuentra actualiza su método de pago
     * Caso contrario, se crea un cliente con la información del request.
     * Después, se crea la orden con los datos del request llamando la función procesar_orden()
     *
     * @param  Request $request
     * @return Retorna ['msg' => 'Cargo realizado'] en caso de que se haya aprobado el cargo
     *         Caso contrario, regresará errores de conekta
     */
    public function crear_cliente(Request $request)
    {
        $direccion = $request->direccion;
        if(!$direccion) {//Si no hay una dirección de envío no se procesa el pago
            return ['msg' => 'No se agregó ninguna dirección de envío.'];
        }
        $direccion_num = $direccion['calle']. " No. Ext: ". $direccion['num_ext'];
        $direccion_num = $direccion['num_int'] ? $direccion_num. " No. Int: ". $direccion['num_int'] : $direccion_num;

        $customer_id_conekta = Usuario::buscar_id_conekta_usuario_app($request->correo);
        if ($customer_id_conekta) {//Se verifica si el usuario ya cuenta con un cliente en conekta
            if (!$request->oxxo) {//Si se trata de un pago con tarjeta se asigna una al cliente
                $customer = \Conekta\Customer::find($customer_id_conekta);

                if (count($customer['payment_sources'])) {//Si tiene algún método de pago extra, entonces que se elimine y se crea uno nuevo
                    $customer->payment_sources[0]->delete();
                }
                $customer = \Conekta\Customer::find($customer_id_conekta);//Se tiene que volver a buscar
                $source = $customer->createPaymentSource(array(
                    'token_id' => $request->conektaTokenId,
                    'type'     => 'card'
                ));
                
                $customer = \Conekta\Customer::find($customer_id_conekta);
            }
            if ($request->oxxo) {
                $response = $this->procesar_orden($request, $customer_id_conekta, $direccion, true);
            } else {
                $response = $this->procesar_orden($request, $customer_id_conekta, $direccion);
            }
            return $response;

        } else {
            try {
                $cliente_args = array(
                    "name" => $request->nombre,
                    "email" => $request->correo,
                    "phone" => $request->telefono,
                    'shipping_contacts' => array(array(
                        'phone' => $request->telefono,
                        'receiver' => $direccion['recibidor'],  
                        'address' => array(
                            'street1' => $direccion_num,
                            'city' => $direccion['ciudad'],
                            'state' => $direccion['estado'],
                            'country' => $direccion['pais'],
                            'postal_code' => $direccion['codigo_postal'],
                            'residential' => $direccion['residencial']
                        )
                    ))
                );

                if ($request->conektaTokenId) {
                    $cliente_args['payment_sources'] = array(
                        array(
                            "type" => "card",
                            "token_id" => $request->conektaTokenId
                        )
                    );
                }

                $cliente = \Conekta\Customer::create(
                    $cliente_args
                );

                Usuario::actualizar_id_conekta_usuario_app($request->correo, $cliente['id']);
                //$customer = \Conekta\Customer::find($cliente->id);
                if ($request->oxxo) {
                    $response = $this->procesar_orden($request, $cliente->id, $direccion, true);
                } else {
                    $response = $this->procesar_orden($request, $cliente->id, $direccion);
                }

                return $response;
                
            } catch (\Conekta\ErrorList $errorList) {
                $msg_errors = '';
                foreach ($errorList->details as &$errorDetail) {
                    $msg_errors .= $errorDetail->getMessage();
                }
                return ['msg' => 'Datos del cliente incorrectos: '.$msg_errors];
            }
        }
    }

    /**
     * Procesa una orden, además de aplicar un porcentaje de descuento en caso de contar con un cupón válido.
     *
     * @param  Request $request
     * @return Retorna ['msg' => 'Cargo realizado'] en caso de que se haya aprobado el cargo
     *         Caso contrario, regresará errores de conekta
     */
    public function procesar_orden($request, $customer_id_conekta, $direccion, $oxxo = false)
    {
        $charge_ar = array();
        if ($oxxo) {
            $hora = date('Y-m-d H:i:s', strtotime($this->actual_datetime. ' + 1 days'));
            $time_number = strtotime($hora);
            $charge_ar["type"] = "oxxo_cash";
            $charge_ar["expires_at"] = $time_number;
        } else {
            $charge_ar["type"] = "default";
        }

        $direccion_num = $direccion['calle']. " No. Ext: ". $direccion['num_ext'];
        $direccion_num = $direccion['num_int'] ? $direccion_num. " No. Int: ". $direccion['num_int'] : $direccion_num;

        $costo_envio = $this->validar_costo_envio($request->productos);
        try {
            $order_args = array(
                "line_items" => $request->productos,
                "shipping_lines" => array(
                    array(
                        "amount" => $costo_envio,
                        "carrier" => "Papá Noel"
                    )
                ), //shipping_lines
                "currency" => "MXN",
                "customer_info" => array(
                    "customer_id" => $customer_id_conekta
                ), //customer_info
                "shipping_contact" => array(
                    "phone" => $request->telefono,
                    "receiver" => $direccion['recibidor'],
                    "address" => array(
                        'street1' => $direccion_num,
                        'city' => $direccion['ciudad'],
                        'state' => $direccion['estado'],
                        'country' => $direccion['pais'],
                        'postal_code' => $direccion['codigo_postal'],
                        'residential' => $direccion['residencial']
                    )//address
                ), //shipping_contact
                "charges" => array(
                    array(
                        "payment_method" => $charge_ar
                    ) //first charge
                ) //charges
            );//order

            $order = \Conekta\Order::create(
                $order_args
            );

            /*Se inserta un nuevo pedido en la base de datos*/
            $servicio = new Servicio;
            
            $servicio->usuario_id = $request->usuario_id;
            $servicio->conekta_order_id = $order->id;
            $servicio->nombre_cliente = $request->nombre;
            $servicio->correo_cliente = $request->correo;
            $servicio->customer_id_conekta = $customer_id_conekta;
            $servicio->costo_total = $order->amount;
            $servicio->telefono = $request->telefono;
            $servicio->last_digits = $request->last_digits;
            $servicio->datetime_formated = $request->datetime_formated;
            $servicio->costo_envio = $costo_envio;

            /*Atributos especiales dependiendo del tipo de pago*/
            $servicio->status = $oxxo ? 'pending_payment' : 'paid';
            $servicio->tipo_orden = $oxxo ? 'oxxo' : 'card';
            $servicio->num_referencia = $oxxo ? $order->charges[0]->payment_method->reference : '';

            $servicio->recibidor = $direccion['recibidor'];
            $servicio->calle = $direccion['calle'];
            $servicio->entre = $direccion['entre'];
            $servicio->num_ext = $direccion['num_ext'];
            $servicio->num_int = $direccion['num_int'];
            $servicio->codigo_postal = $direccion['codigo_postal'];
            $servicio->ciudad = $direccion['ciudad'];
            $servicio->estado = $direccion['estado'];
            $servicio->pais = 'MX';
            $servicio->created_at = $this->actual_datetime;

            $servicio->save();

            $this->guardar_detalles_servicio($servicio->id, $request->productos);

            if ($oxxo) {
                $referencia = $order->charges[0]->payment_method->reference;
                $total = $order->amount/100;
                $moneda = $order->currency;
                $this->enviar_correo_referencia_oxxo($referencia, $total, $moneda, $servicio->correo_cliente);
                //$this->enviar_num_referencia_correo($order->charges[0]->payment_method->reference, "$". $order->amount/100 . $order->currency);
                return [
                    'msg' => 'Pago con OXXO PAY solicitado', 
                    'reference' => $referencia, 
                    'total_to_pay' => "$". $total. ' ' .$moneda
                ];

            } else {
                return ['msg' => 'Cargo realizado'];
            }
            
        } catch (\Conekta\ErrorList $errorList) {
            $msg_errors = '';
            
            foreach($errorList->details as &$errorDetail) {
                $msg_errors .= $errorDetail->getMessage();
            }
            return ['msg' => 'Cargo no realizado: '.$msg_errors];
        }
    }//End function

    /**
     * Valida el costo de envío, si está activado o si el total de compra supera la tarífa mínima de envío.
     *
     * @param  int $empresa_id
     */
    public function validar_costo_envio($productos)
    {
        $total_productos = 0;
        $cat_ids = [];

        foreach ($productos as $producto) { $total_productos += ($producto['unit_price'] * $producto['quantity']); }//Se obtiene el costo total
        
        foreach ($productos as $producto) { 
            $prod = Producto::where('id', $producto['producto_id'])->first();
            $categoria = Categoria::where('id', $prod->categoria_id)->first();
            $cat_ids [] = $categoria->id;
        }

        $tarifa = Categoria::whereIn('id', $cat_ids)
        ->orderBy('monto_minimo_envio', 'DESC')
        ->where('costo_envio', 1)
        ->first();
        
        if (!$tarifa) {//No hay tarifas de envío.
            return 0;
        }

        if ($total_productos >= ($tarifa->monto_minimo_envio * 100)) {
            return 0;
        } else {
            return $tarifa->tarifa_envio * 100;
        }
    }

    /**
     * Regresa todos los pedidos de un usuario.
     *
     * @return $pedidos
     */
    public function obtener_pedidos_usuario(Request $request)
    {
        $pedidos = Servicio::obtener_pedidos_usuario($request->usuario_id);
        foreach ($pedidos as $pedido) {
            $pedido->pedido_detalles = ServicioDetalle::where('servicio_id', $pedido->id)->get();
        }
        return $pedidos;
    }

    /**
     * Guarda una orden de paypal.
     * 
     */
    public function guardar_pedido_paypal(Request $request)
    {
        $direccion = $request->direccion;
        
        $servicio = new Servicio;
        
        $servicio->usuario_id = $request->usuario_id;
        $servicio->paypal_order_id = $request->paypal_order_id;
        $servicio->nombre_cliente = $request->nombre;
        $servicio->correo_cliente = $request->correo;
        $servicio->costo_total = $request->costo_total;
        $servicio->telefono = $request->telefono;
        $servicio->datetime_formated = $request->datetime_formated;
        $servicio->costo_envio = $request->costo_envio;

        /*Atributos tipo de pago*/
        $servicio->status = 'paid';
        $servicio->tipo_orden = 'paypal';

        $servicio->recibidor = $direccion['recibidor'];
        $servicio->calle = $direccion['calle'];
        $servicio->entre = $direccion['entre'];
        $servicio->num_ext = $direccion['num_ext'];
        $servicio->num_int = $direccion['num_int'];
        $servicio->codigo_postal = $direccion['codigo_postal'];
        $servicio->ciudad = $direccion['ciudad'];
        $servicio->estado = $direccion['estado'];
        $servicio->pais = 'MX';
        $servicio->created_at = $this->actual_datetime;

        $servicio->save();

        $this->guardar_detalles_servicio($servicio->id, $request->productos);

        return ['msg' => 'Cargo por paypal registrado'];
    }

    /**
     * Guarda los detalles de una orden.
     * 
     */
    public function guardar_detalles_servicio($servicio_id, $productos)
    {
        foreach ($productos as $producto) {
            $arbol = Producto::producto_detalles($producto['producto_id']);
        
            $item = New ServicioDetalle;

            $item->servicio_id = $servicio_id;
            $item->nombre_producto = $producto['name'];
            $item->precio = $producto['unit_price'];
            $item->cantidad = $producto['quantity'];
            $item->foto_producto = $producto['foto_producto'];
            $item->color_id = $producto['color_id'];
            $item->color = $producto['color'];
            /*Detalles del árbol*/
            $item->categoria = $arbol->categoria;
            $item->altura = $arbol->altura;
            $item->puntas = $arbol->puntas;
            $item->ancho = $arbol->ancho;
            $item->peso_empaque = $arbol->peso_empaque;
            $item->dimensiones_empaque = $arbol->dimensiones_empaque;
            $item->tipo_armado = $arbol->armado;
            $item->secciones = $arbol->secciones;
            $item->tipo_pata_soporte = $arbol->pata_soporte;

            $item->created_at = $this->actual_datetime;

            $item->save();
        }
    }

    /**
     * Envía un correo con el número de referencia
     * 
     */
    public function enviar_correo_referencia_oxxo($referencia, $total, $moneda, $correo_cliente)
    {
        Mail::send('emails.oxxo', ['total' => $total, 'referencia' => $referencia], function ($message)  use ($correo_cliente)
        {
            $message->to($correo_cliente);
            $message->subject('Papá Noel | Número de referencia OXXO');
        });
    }
    
    /**
     *==================================================================================================================================================================
     *=                                                    Finalizan las funciones relacionadas a la api de conekta                                                    =
     *==================================================================================================================================================================
     */

    /**
     *===================================================================================================================================================================
     *=                                       Empiezan las funciones relacionadas a las notificaciones usando la api de onesignal                                       =
     *===================================================================================================================================================================
     */

    /**
     * Actualiza el player_id de un usuario
     * 
     * @return json
     */
    public function actualizar_player_id(Request $req)
    {
        $user = Usuario::find($req->usuario_id);
        $user->player_id = $req->player_id;
        $user->save();

        return response(['msg' => 'Player ID modificado con éxito'], 200);
    }

    /**
    * Envía una notificación individual a un usuario que puede ser repartidor o cliente
    * @return $response
    */
    public function enviar_notificacion_individual($title, $mensaje, $data, $player_ids)
    {
        $content = array(
            "en" => $mensaje
        );
        $header = array(
            "en" => $title
        );
        
        $fields = array(
            'app_id' => $this->app_id,
            'include_player_ids' => $player_ids,
            'data' => $data,
            'headings' => $header,
            'contents' => $content,
            'small_icon' => $this->small_icon,
            'large_icon' => $this->regular_icon
        );
        
        
        $fields = json_encode($fields);
 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   "Authorization: Basic $this->app_key"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
    }

    /**
    * Esta función únicamente se usará para pruebas y puede variar su contenido y response
    * @return $response
    */
    public function test() {
        return;
    }
}
