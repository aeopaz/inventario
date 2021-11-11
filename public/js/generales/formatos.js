//Formato de moneda
function formato_moneda(campo) {
    $("#" + campo).on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value) {
                return value.replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
            });
        }
    });
}

//Formato de teléfono
function formato_telefono(campo) {
    var elementExists = document.getElementById(campo);
    if (elementExists) {
        elementExists.addEventListener('input', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : + x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : '');

        });
    }
}

//Función validar expresiones regulares a campos
function expresion_regular(campo, expresion, tamano) {
    var valor_campo = document.getElementById(campo).value;//Obtiene el valor ingresado
    var elemento = document.getElementById(campo);//Obtiene el elemento como DOM
    var expreg = new RegExp(expresion);//Crea una expresión regular con la expresión recibida
    quitar_mensaje_error(campo)

    if (expreg.test(valor_campo) == false) {//Valida si la placa ingresada cumple con el formato
        mostrar_mensaje_error(campo)
    }

    if (elemento.value.length > tamano) {//Valida si el valor ingresado por el usuario supera al tamaño permitido
        elemento.value = elemento.value.slice(0, tamano);//Si lo supera, lo corta al tamaño permitido
    }
}

//Función para aceptar sólo números con una longitud
function validar_campo_numerico(campo, longitud) {
    $('input#' + campo)
        .keypress(function (event) {
            // El código del carácter 0 es 48
            // El código del carácter 9 es 57
            if (event.which < 48 || event.which > 57 || this.value.length === longitud) {
                return false;
            }
        });
}

//Formato para números de identificación
function formato_numero_id(campo) {
    $("#" + campo).on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            if(this.value.length>13){
                this.value=this.value.slice(0, 13);
            }
            $(event.target).val(function (index, value) {
                return value.replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");

            });
        }
    });
}


