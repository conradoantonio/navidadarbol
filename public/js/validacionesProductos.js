/*Código para validar el formulario de datos del usuario*/
var inputs = [];
mb = 0;
fileExtension = ['jpg', 'jpeg', 'png'];
var msgError = '';
var regExprTexto = /^[\* a-z A-Z ñ # , : ; ¿ ? ! ¡ ' " _ @ ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,}$/i;
var regExprNum = /^[\d .]{1,}$/i;
var btn_enviar_producto = $("#guardar_producto");
btn_enviar_producto.on('click', function() {
    inputs = [];
    msgError = '';

    validarSelect($('select#categoria_id')) == false ? inputs.push('Categoría') : ''
    validarInput($('input#altura'), regExprTexto) == false ? inputs.push('Altura') : ''
    validarInput($('input#puntas'), regExprNum) == false ? inputs.push('Puntas') : ''
    validarInput($('input#ancho'), regExprTexto) == false ? inputs.push('ancho') : ''
    validarInput($('input#peso_empaque'), regExprTexto) == false ? inputs.push('Peso empaque') : ''
    validarInput($('input#dimensiones_empaque'), regExprTexto) == false ? inputs.push('Dimensiones empaque') : ''
    validarSelect($('select#armado_id')) == false ? inputs.push('Armado') : ''
    validarInput($('input#secciones'), regExprNum) == false ? inputs.push('Secciones') : ''
    validarSelect($('select#pata_soporte_id')) == false ? inputs.push('Pata soporte') : ''
    validarInput($('input#precio'), regExprNum) == false ? inputs.push('Precio') : ''

    if (inputs.length == 0) {
        $(this).children('i').show();
        $(this).attr('disabled', true);
        subirProducto($(this));
    } else {
        swal("Corrija los siguientes campos para continuar: ", msgError);
        return false;
    }
});

$( "select#categoria_id" ).change(function() {
    validarSelect($(this));
});
$( "input#altura" ).blur(function() {
    validarInput($(this), regExprTexto);
});
$( "input#puntas" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "input#ancho" ).blur(function() {
    validarInput($(this), regExprTexto);
});
$( "input#peso_empaque" ).blur(function() {
    validarInput($(this), regExprTexto);
});
$( "input#dimensiones_empaque" ).blur(function() {
    validarInput($(this), regExprTexto);
});
$( "select#armado_id" ).change(function() {
    validarSelect($(this));
});
$( "input#secciones" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "select#pata_soporte_id" ).change(function() {
    validarSelect($(this));
});
$( "input#precio" ).blur(function() {
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

function validarSelect (select) {
    if ($(select).val() == '0' || $(select).val() == '' || $(select).val() == null) {
        $(select).parent().addClass("has-error");
        msgError = msgError + $(select).parent().children('label').text() + '\n';
        return false;
    } else {
        $(select).parent().removeClass("has-error");
        return true;
    }
}

/*$('input#foto_producto').bind('change', function() {
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

function validarArchivo(campo, div) {
    archivo = $(campo).val();
    extension = archivo.split('.').pop().toLowerCase();

    if ($(div).is(":visible") && ($(campo).val() == '' || $(campo).val() == null)) {
        return true;
    } else if ($.inArray(extension, fileExtension) == -1 || mb >= 5) {
        $(campo).parent().addClass("has-error");
        msgError = msgError + $(campo).parent().children('label').text() + '\n';
        return false;
    } else {
        $(campo).parent().removeClass("has-error");
        return true;
    }
}*/
/*Fin de código para validar el formulario de datos del usuario*/

/*Código para validar el archivo que importa datos desde excel*/
var btn_enviar_excel = $("#enviar-excel");
btn_enviar_excel.on('click', function() {
    fileExtension = ['xls', 'xlsx'];
    archivo = $("#archivo-excel").val();
    extension = archivo.split('.').pop().toLowerCase();

    if ($.inArray(extension, fileExtension) == -1) {
        swal({
            title: "Error",
            text: "<span>Solo son admitidos archivos con extensión <strong>xls y xlsx</strong><br>Extensión de archivo seleccionado: <strong>"+ extension +" </strong></span>",
            type: "error",
            html: true,
            confirmButtonColor: "#286090",
            confirmButtonText: "Aceptar",
            closeOnConfirm: false,
        });
        return false;
    } else {
        $(this).children('i').show();
        $(this).attr('disabled', true);
        cargarExcelProductos($(this));
    }
});

var btn_enviar_excel_categorias = $("#enviar-excel-categorias");
btn_enviar_excel_categorias.on('click', function() {
    fileExtension = ['xls', 'xlsx'];
    archivo = $("#archivo-excel-categorias").val();
    extension = archivo.split('.').pop().toLowerCase();

    if ($.inArray(extension, fileExtension) == -1) {
        swal({
            title: "Error",
            text: "<span>Solo son admitidos archivos con extensión <strong>xls y xlsx</strong><br>Extensión de archivo seleccionado: <strong>"+ extension +" </strong></span>",
            type: "error",
            html: true,
            confirmButtonColor: "#286090",
            confirmButtonText: "Aceptar",
            closeOnConfirm: false,
        });
        return false;
    } else {
        $('#enviar-excel-categorias').hide();
        $('#enviar-excel-categorias').submit();
    }
});
/*Fin del código para validar el archivo que importa datos desde excel*/