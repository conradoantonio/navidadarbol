<!DOCTYPE html>
<html>
<head>
	<title>Oxxo pay</title>
</head>
<style type="text/css">
	html{
		font-family: sans-serif;
	}
	body{
		margin:auto;
		width: 100%;
	}
	#recibo{
		margin:auto;
	}
	.recibo_body{
		width: 75%;
		margin: auto;
		border: 1px solid black;
		border-radius: 0px 0px 5px 5px;
		padding-bottom: 15px;
	}
	.upper{
		text-transform: uppercase;
	}
	.normal{
		text-transform: capitalize;
		font-size: 13px;
	}
	.center{
		text-align: center;
	}
	.header{
		margin:auto;
		text-transform: uppercase;
		background: black;
		text-align: center;
    	padding: 12px;
	}
	.header span{
		color: white;
	}
	.col-6{
		width: 49%;
		display: inline-block;
	}
	.margin-bottom{
		margin-bottom: 12px;
	}
	.referencia{
		margin: auto;
		width: 70%;
	}
	.referencia .numero{
		display: block;
		font-weight: 900;
		border: 1px solid black;
		text-align: center;
		padding: 10px;
		letter-spacing: 8px;
		border-radius: 10px;
	}
	.instrucciones, .alert{
		width: 80%;
		margin: auto;
	}
	ol li{
		padding: 5px 0px;
		text-align: justify;
	}
	.alert{
		width: 61%;
		border: 1px solid #48943B;
	}
	.alert p{
		padding: 0px 18%;
		color: #48943B;
		text-align: justify;
	}
</style>
<body>
    <div class='header1'>
		<div>
			<img src='https://www.navidad.belyapp.com/img/header_mail.png' style='width: 100%;'>
		</div>
	</div>
	<div id="recibo" style="margin:auto;">
		<div class="header" style="margin:auto;text-transform: uppercase;background: black;text-align: center;padding: 12px;">
			<span style="color: white;">¡Número de guía asignado!</span>
		</div>
		<div class="recibo_body" style="width: 75%;margin: auto;border: 1px solid black;border-radius: 0px 0px 5px 5px;padding-bottom: 15px;">
			<div class="instrucciones" style="margin: auto;">
				<h4 style="margin-left: 1em;">Estimado {{$nombre_cliente}}:</h4>
				<ol style="width: 90%;">
					<li style="padding: 5px 0px;text-align: justify;">Se le informa que su pedido con el número {{$order_id}} realizado el día {{$fecha}} por la cantidad de ${{$monto}} MXN tiene ahora asignado el número de guía {{$num_guia}} a través de la paquetería {{$paqueteria}}.</li>
					<li style="padding: 5px 0px;text-align: justify;">Vaya al módulo de pedidos para consultar esta información.</li>
				</ol>
			</div>
		</div>
	</div>
</body>
</html>