//Crear proveedor
$(function () {
    $('#form_crear_proveedor').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        $(".invalid-feedback").children("strong").text("");
        $("#msj").children("strong").text("");
        $("#form_crear_proveedor input").removeClass("is-invalid");
        var url = "/proveedor/store/";
        $.ajax({
            method: "POST",
            headers: {
                Accept: "application/json"
            },
            url: url,
            data: formData,
            success: () => {
                Swal.fire(
                    'Confirmación',
                    'El proveedor se ha creado',
                    'success'
                )
                setTimeout(function(){ location.reload() }, 2000);//Actualizar página en 2 segundos
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


//Actualizar proveedor (recordar que el boton no debe tener type)
$(function () {
    $('#form_actualizar_proveedor').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        $(".invalid-feedback").children("strong").text("");
        $("#msj").children("strong").text("");
        $("#form_actualizar_proveedor input").removeClass("is-invalid");
        var url = $("#form_actualizar_proveedor").attr('action')//Capturo la accion del formulario
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
                    'El proveedor se ha actualizado',
                    'success'
                )
                setTimeout(function(){ location.reload() }, 2000);//Actualizar página en 2 segundos
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


