<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	if (auth()->check()) {
		return redirect()->action('LogController@index');
	} else {
    	return view('welcome');//login
    }
});

/*-- Rutas para el login --*/
Route::resource('log', 'LogController');
Route::post('login', 'LogController@store');
Route::get('logout', 'LogController@logout');

/*-- Rutas para el dashboard --*/
Route::get('/dashboard','LogController@index');//Carga solo el panel administrativo
Route::post('/grafica', 'LogController@get_userSesions');//Carga los datos de la gráfica

/*-- Rutas para la pestaña de usuariosSistema --*/
Route::get('/usuarios/sistema','UsersController@index');//Carga la tabla de usuarios del sistema
Route::post('/usuarios/sistema/validar_usuario', 'UsersController@validar_usuario');//Checa si un usuario del sistema existe
Route::post('/usuarios/sistema/guardar_usuario', 'UsersController@guardar_usuario');//Guarda un usuario del sistema
Route::post('/usuarios/sistema/guardar_foto_usuario_sistema', 'UsersController@guardar_foto_usuario_sistema');//Guarda la foto de perfil de un usuario del sistema
Route::post('/usuarios/sistema/eliminar_usuario', 'UsersController@eliminar_usuario');//Elimina un usuario del sistema
Route::post('/usuarios/sistema/change_password', 'UsersController@change_password');//Elimina un usuario del sistema

/*-- Rutas para la pestaña usuariosApp--*/
Route::get('/usuarios/app','UsersController@usuariosApp');//Carga la tabla de usuarios de la aplicación
Route::get('/usuarios/app/exportar_usuarios_app','ExcelController@exportar_usuarios_app');//Exporta todos los usuarios de la aplicación a excel
Route::post('/usuarios/app/guardar_usuario_app', 'UsersController@guardar_usuario_app');//Guarda un nuevo usuario de la aplicación
Route::post('/usuarios/app/editar_usuario_app', 'UsersController@editar_usuario_app');//Edita un usuario de la aplicación
Route::post('/usuario/cambiarStatus', 'UsersController@destroy');//Da de baja un usuario

/*-- Ruta para la pestaña de productos --*/
Route::get('/productos','ProductosController@index');//Carga la vista de productos del sistema
Route::get('/productos/tabla','ProductosController@index_table');//Carga la tabla html de productos
Route::post('/productos/guardar', 'ProductosController@guardar_producto');//Guarda un producto
Route::post('/productos/editar', 'ProductosController@editar_producto');//Edita un producto
Route::post('/productos/eliminar', 'ProductosController@eliminar_producto');//Elimina un producto
Route::post('/productos/eliminar_multiples', 'ProductosController@eliminar_multiples_productos');//Elimina varios productos
Route::post('/productos/importar_productos', ['as' => '/productos/importar_productos', 'uses' => 'ExcelController@importar_productos']);//Carga los productos a excel
Route::post('/productos/importar_categorias', ['as' => '/productos/importar_categorias', 'uses' => 'ExcelController@importar_categorias']);//Carga los productos a excel
Route::get('/productos/exportar_productos/{fecha_inicio}/{fecha_fin}', 'ExcelController@exportar_productos');//Exporta ciertos productos a excel
Route::post('/productos/cargar_subcategorias', 'ProductosController@cargar_subcategorias');//Carga las subcategorías de una categoría.

/*-- Ruta para la pestaña de cargar colores --*/
Route::get('/colores','CategoriaFotosController@colores');//Carga la vista de las fotos (colores) disponibles.
Route::post('/colores/subir','CategoriaFotosController@subir_color');//Sube una foto (color).
Route::post('/colores/editar','CategoriaFotosController@editar_color');//Edita una foto (color).
Route::post('/colores/eliminar','CategoriaFotosController@eliminar_color');//Elimina una foto (color).

/*-- Ruta para la pestaña de asignar color categoría --*/
Route::get('/asignar_color_categorias','CategoriaFotosController@index');//Carga la vista con las categorías disponibles para que carguen sus fotos.
Route::post('/asignar_color_categorias/actualizar','CategoriaFotosController@actualizar_colores_categoria');//Lista las fotos de una categoría.
Route::post('/asignar_color_categorias/eliminar','CategoriaFotosController@eliminar_color_categoria');//Elimina una foto de una categoría.
Route::post('/asignar_color_categorias/listar_colores','CategoriaFotosController@listar_colores_categoria');//Lista los colores de una categoría en una galería.

/*-- Ruta para la pestaña de asignar foto categoría --*/
Route::get('/asignar_foto_categorias','CategoriaFotosController@fotos');//Carga la vista con las categorías disponibles para que carguen sus fotos.
Route::post('/categoria_colores','CategoriaFotosController@categoria_colores');//Guarda una foto para una categoría
Route::post('/categoria_galeria_fotos','CategoriaFotosController@categoria_galeria_fotos');//Guarda una foto para una categoría
Route::post('/agregar_foto_categoria','CategoriaFotosController@agregar_foto_categoria');//Guarda una foto para una categoría
Route::post('/editar_foto_categoria','CategoriaFotosController@editar_foto_categoria');//Edita una foto para una categoría.
Route::post('/eliminar_foto_categoria','CategoriaFotosController@eliminar_foto_categoria');//Elimina una foto para una categoría.

/*-- Rutas para la pestaña cargar imagenes --*/
Route::get('/cargar_imagenes','ImagenController@index');//Carga el formulario de dropzone para cargar imagenes
Route::post('/subir_imagenes','ImagenController@subir_imagenes');//Carga las imágenes al servidor

/*-- Ruta para los tipos de productos dentro de la pestaña de productos*/
Route::post('/tipo_producto/guardar_tipo_producto', 'ProductosController@guardar_tipo_producto');//Guarda un tipo de producto.
Route::post('/tipo_producto/editar_tipo_producto', 'ProductosController@editar_tipo_producto');//Guarda un tipo de producto.
Route::post('/tipo_producto/eliminar_tipo_producto', 'ProductosController@eliminar_tipo_producto');//Guarda un tipo de producto.

/*-- Rutas para la pestaña de configuración --*/
Route::get('/noticias','NoticiasController@index');//Carga la tabla de noticias.
Route::post('/noticias/guardar', 'NoticiasController@guardar');//Guarda una noticia.
Route::post('/noticias/editar', 'NoticiasController@editar');//Edita una noticia.
Route::post('/noticias/eliminar', 'NoticiasController@eliminar');//Elimina una noticia.

/*-- Rutas para la pestaña de subcategorías --*/
Route::get('/subcategorias_app','MenuController@subcategorias');//Muestra las subcategorías de la aplicación.
Route::post('/subcategorias_app/guardar','MenuController@subcategorias_guardar');//Guarda una subcategoría.
Route::post('/subcategorias_app/editar','MenuController@subcategorias_editar');//Edita una subcategoría.
Route::post('/subcategorias_app/eliminar','MenuController@subcategorias_eliminar');//Elimina una subcategoría.
Route::post('/subcategorias_app/eliminar_multiples','MenuController@subcategorias_eliminar_multiples');//Elimina varias subcategorías.

/*-- Rutas para la pestaña de pedidos --*/
Route::get('/pedidos','ServiciosController@index');//Carga la vista para los pedidos realizados del panel
Route::post('/pedidos/agregar_num_seguimiento','ServiciosController@agregar_num_seguimiento');//Agrega un número de seguimiento a un pedido
Route::post('/pedidos/obtener_info_pedido','ServiciosController@obtener_pedido_por_id');//Obtiene la información de un pedido por su id.
Route::post('/pedidos/asignar_num_guia','ServiciosController@asignar_num_guia');//Asigna un número de guía a un pedido.

/*-- Rutas para la subpestaña de información empresa --*/
Route::get('/configuracion/info_empresa','ConfiguracionController@info_empresa');//Carga la vista para la información de la empresa.
Route::post('/configuracion/info_empresa/guardar','ConfiguracionController@guardar_info_empresa');//Guarda la información de la empresa.
Route::post('/configuracion/info_empresa/editar','ConfiguracionController@editar_info_empresa');//Edita la información de la empresa.

/*-- Ruta para iframe --*/
Route::group(['prefix' => 'notificaciones_app', 'middleware' => 'auth'], function () {
	Route::get('/','NotificacionesController@index');//Carga el panel para mandar notificaciones a la aplicación.
	Route::post('/enviar/general','NotificacionesController@enviar_notificacion_general');//Carga el panel para mandar notificaciones a la aplicación.
	Route::post('/enviar/individual','NotificacionesController@index');//Carga el panel para mandar notificaciones a la aplicación.
});


/*-- Ruta para cargar codigo postales desde excel --*/
Route::post('/cargar/codigo_postal','ExcelController@cargar_excel_cp');//Carga un excel con los códigos postales de jalisco

/*-- Rutas para la pestaña de galería --*/
Route::get('/galeria','ImagenController@cargar_galeria');//Carga el login de ionic
Route::post('/galeria/eliminar', 'ImagenController@eliminar_galeria');//Da de baja un usuario

/*-- google analytics --*/
Route::get('/data','estadosController@analytics');//Devuelve los datos de google analytics
Route::post('/check_order','ServiciosController@webhook_conekta');//Activa un webhook 

/**
 *===========================================================================================================================================================
 *=                                             Empiezan las funciones relacionadas a la api para la aplicación                                             =
 *===========================================================================================================================================================
 */
Route::get('/form','dataAppController@cargar_form_conekta');//Carga el formulario de prueba de conekta

Route::post('/generar_token','dataAppController@generar_token');//Genera un token de prueba
Route::post('/post_send','dataAppController@post_send');//Procesa los datos después de generar el token
Route::get('/app/cupones_validos_usuario/{usuario_id}','dataAppController@cupones_validos_usuario');//Regresa todos los cupones válidos del usuario incluyendo los generales.
Route::post('app/validar_cargo','dataAppController@crear_cliente');//Crea un cliente
Route::post('/app/guardar_paypal_cargo','dataAppController@guardar_pedido_paypal');//Crea un cliente
//Route::post('/crear_cliente','dataAppController@crear_cliente');//Crea un cliente
Route::post('/procesar_orden','dataAppController@procesar_orden');//Procesa una orden
Route::post('/app/orden_empresa','dataAppController@obtener_ordenes');//Obtiene las pedidos de las empresas

Route::post('/app/registro_usuario','dataAppController@registro_app');//Registra un usuario en la aplicación.
Route::post('/app/login','dataAppController@login_app');//Valida el inicio de sesión de un usuario en la aplicación.
Route::post('/app/actualizar_usuario','dataAppController@actualizar_datos_usuario');//Actualiza los datos del usuario a excepción de la contraseña, email y foto.
Route::post('/app/recuperar_contra','dataAppController@recuperar_contra');//Envía una contraseña nueva generada automáticamente al correo del usuario.
Route::post('/app/actualizar_foto','dataAppController@actualizar_foto');//Actualiza la foto de perfil de un usuario.
Route::post('/app/agregar_favorito','dataAppController@agregar_favorito');//Agrega una categoría como favorito.
Route::post('/app/remover_favorito','dataAppController@remover_favorito');//Remueve una categoría como favorito.
Route::post('/app/agregar_direccion','dataAppController@agregar_direccion_usuario_app');//Agrega una dirección para el usuario.
Route::post('/app/actualizar_direccion','dataAppController@actualizar_direccion_usuario_app');//Actualiza una dirección del usuario.
Route::post('/app/listar_direcciones','dataAppController@listar_direcciones');//Muestra una lista de todas las direcciones del usuario de la aplicación.
Route::post('/app/eliminar_direccion','dataAppController@eliminar_direccion_usuario_app');//Elimina una dirección del usuario de la aplicación.
Route::post('/app/calificar_servicio','dataAppController@calificar_servicio');//Califica un servicio y lo marca como terminado.
Route::get('/app/noticias','dataAppController@mostrar_noticias');//Regresa las noticias para mostrar en la aplicación.
Route::post('/app/productos_categoria','dataAppController@productos_categoria');//Regresa todos los productos enlistados por categorias.
Route::post('/app/info_empresas','dataAppController@info_empresas');//Muestra la información de las empresas de la plataforma.
Route::post('/app/info_empresas/costo_envios','dataAppController@informacion_envio');//Muestra la información de envío de las empresas.
Route::get('/app/preguntas_frecuentes','dataAppController@obtener_preguntas_frecuentes');//Regresa todas las preguntas frecuentes de la aplicación.
Route::post('/app/verificar_codigo_postal','dataAppController@verificar_codigo_postal');//Regresa todas las preguntas frecuentes de la aplicación.
Route::post('/app/obtener_pedidos_usuario','dataAppController@obtener_pedidos_usuario');//Devuelve los pedidos del usuario hechas desde la aplicación.
Route::post('/app/enviar_correo_detalle_orden','dataAppController@enviar_correo_detalle_orden');//Envía un correo electrónico con los detalles de la orden.
Route::post('/app/enviar_correo_detalle_cotizacion','dataAppController@enviar_correo_detalle_cotizacion');//Envía un correo electrónico con los detalles de la cotización.
Route::get('/app/menu_detalles','dataAppController@categorias');//Envía un correo electrónico con los detalles de la cotización.

#onesignal
Route::post('/app/actualizar_player_id','dataAppController@actualizar_player_id');//Actualiza el player id de un usuario de la aplicación
Route::post('/app/test', 'dataAppController@test');
