/*Código para validar el formulario de datos del usuario*/
var inputs = [];
mb = 0;
fileExtension = ['jpg', 'jpeg', 'png'];
var msgError = '';
var regExprTexto = /^[a-z ñ # , : ; ¿ ? ! ¡ ' " _ @ ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,}$/i;
var regExprNum = /^[\d .]{1,}$/i;
var btn_enviar = $("#guardar_categoria");
$('body').delegate('button#guardar_categoria','click', function() {
    inputs = [];
    msgError = '';

    validarInput($('input#tipo_producto'), regExprTexto) == false ? inputs.push('Tipo producto') : ''
    validarInput($('input#monto_minimo_envio'), regExprNum) == false ? inputs.push('Monto mínimo para envío gratuito') : ''
    validarInput($('input#tarifa_envio'), regExprNum) == false ? inputs.push('Tarifa envío') : ''
    validarArchivo($('input#imagen_categoria')) == false ? inputs.push('Imagen categoria') : ''

    if (inputs.length == 0) {
        $(this).find('i').show(); $(this).attr('disabled', true);
        actualizarCategoria($(this));
    } else {
        $(this).show();
        swal("Corrija los siguientes campos para continuar: ", msgError);
        return false;
    }
});

$( "input#tipo_producto" ).blur(function() {
    validarInput($(this), regExprTexto);
});
$( "input#monto_minimo_envio" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "input#tarifa_envio" ).blur(function() {
    validarInput($(this), regExprNum);
});

function validarInput (campo,regExpr) {
    if (!$(campo).val().match(regExpr)) {
        $(campo).parent().addClass("has-error");
        msgError = msgError + $(campo).parent().children('label').text() + '\n';
        return false;
    } else {
        $(campo).parent().removeClass("has-error");
        return true;
    }
}

$('input#imagen_categoria').bind('change', function() {
    if ($(this).val() != '') {

        kilobyte = (this.files[0].size / 1024);
        mb = kilobyte / 1024;

        archivo = $(this).val();
        extension = archivo.split('.').pop().toLowerCase();

        if ($.inArray(extension, fileExtension) == -1 || mb >= 5) {
            swal({
                title: "Archivo no válido",
                text: "Debe seleccionar una imágen con formato jpg, jpeg o png, y debe pesar menos de 5MB",
                type: "error",
                closeOnConfirm: false
            });
        }
    }
});

function validarArchivo(campo) {
    archivo = $(campo).val();
    extension = archivo.split('.').pop().toLowerCase();

    if($('form#form_tipos input#tipo_producto_id').val() != '' && ($(campo).val() == '' || $(campo).val() == null)) {
        return true;
    } else if ($.inArray(extension, fileExtension) == -1 || mb >= 5) {
        $(campo).parent().addClass("has-error");
        msgError = msgError + $(campo).parent().children('label').text() + '\n';
        return false;
    } else {
        $(campo).parent().removeClass("has-error");
        return true;
    }
}
