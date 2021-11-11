
var descripcion = document.getElementById('descripcion');
if (descripcion) {
    descripcion.addEventListener("keyup", function () {
        document.getElementById('contador').innerHTML = 200 - descripcion.value.length + " Caracteres";
    });
}
var precio_venta = document.getElementById('precio_venta');
if (precio_venta) {
    precio_venta.addEventListener("keyup", function () {
        formato_moneda("precio_venta")

    });
}

//Actualizar artículo
$(function () {
    $('#form_actualizar_articulo').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        var id_articulo = document.getElementById('id_articulo').innerHTML;
        $(".invalid-feedback").children("strong").text("");
        $("#msj").children("strong").text("");
        $("#form_actualizar_articulo input").removeClass("is-invalid");
        var url = "/articulo/update/" + id_articulo;
        $.ajax({
            method: "PUT",
            headers: {
                Accept: "application/json"
            },
            url: url,
            data: formData,
            success: () => {
                Swal.fire(
                    'Confirmación',
                    'El Artículo se ha actualizado',
                    'success'
                ).then((result) => {
                    if (result.isConfirmed) {
                        location.reload(true);
                    }
                })
            },
            error: (response) => {
                if (response.status === 422) {
                    let errors = response.responseJSON.errors;
                    Object.keys(errors).forEach(function (key) {
                        $("#" + key).addClass("is-invalid");
                        $("#" + key + "Error").children("strong").text(errors[key][0]);
                    });
                } else {
                    //window.alert("Se creó correctamente");
                }
            }
        })
    });
});

//Previsualizar imagen antes de subirla al servidor
function archivo(evt) {
    var imagen_actual = document.getElementById('imagen_actual');
    if (imagen_actual) {
        document.getElementById('imagen_actual').hidden = true;
    }
    var files = evt.target.files; // FileList object

    //Obtenemos la imagen del campo "file".
    for (var i = 0, f; f = files[i]; i++) {
        //Solo admitimos imágenes.
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();

        reader.onload = (function (theFile) {
            return function (e) {
                // Creamos la imagen.
                document.getElementById("list").innerHTML = ['<img width="200" height="200" style="border: 1px solid #000; margin: 10px 5px 0 0; mb-5" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
            };
        })(f);

        reader.readAsDataURL(f);
    }
}
var file = document.getElementById('file');
if (file) {
    document.getElementById('file').addEventListener('change', archivo, false);
}


