var precio_unitario = document.getElementById('precio_unitario');
var precio_total = document.getElementById('precio_total');
var descuento = document.getElementById('descuento');
var precio_venta = document.getElementById('precio_venta');
var cantidad = document.getElementById('cantidad');
var articulo = document.getElementById('articulo');
var stock = document.getElementById('stock');
var forma_pago = document.getElementById('forma_pago');


//Ejecuta la función datos_articulo al seleccionar un artículo
articulo.addEventListener("change", function () {
    datos_articulo(articulo.value);//Ejecuta esta función para traer el precio del artículo

});
//Calcula el precio total al ingresar valores en precio_unitario
precio_unitario.addEventListener("keyup", function () {
    //formato_moneda('precio_unitario');//Da formato de moneda
    precio_total.value = precio_unitario.value.replace(/\./g, '') * cantidad.value//Limpia precio unitario quitando puntos y lo múltiplica por cantidad
    separar_miles(precio_total)
});
//Calcula el precio total al ingresar valores en cantidad
cantidad.addEventListener("keyup", function () {
    precio_total.value = precio_unitario.value.replace(/\./g, '') * cantidad.value //Limpia precio unitario quitando puntos y lo múltiplica por cantidad
    separar_miles(precio_total)
});
//Calcula el precio de venta al seleccionar descuento
descuento.addEventListener("change", function () {
    precio_venta.value = precio_total.value.replace(/\./g, '') - (precio_total.value.replace(/\./g, '') * descuento.value / 100)//Limpia precio total quitando puntos calcula el valor de venta con descuento
    separar_miles(precio_venta)
});

forma_pago.addEventListener('change',function(){
    if(forma_pago.value==2){
        document.getElementById('seccion_cuotas').hidden=false;
    }else{
        document.getElementById('seccion_cuotas').hidden=true;
    }


});






//Separa en miles
function separar_miles(campo) {//Separa en miles un número
    var x = campo.value.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
    campo.value = x

}
//Trae los datos del artículo seleccionado por el usuario
function datos_articulo(id_articulo) {//Trae el valor unitario del artículo
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

    fetch('/salida/consultar_articulo', { //Corresponde a la función creada en el controlador  SalidasController
        method: 'POST',
        body: JSON.stringify({ id_articulo: id_articulo }),
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    }).then(response => { //Se obtiene el resultado devuelto por la función consultar_articulo
        return response.json()
    }).then(data => {
        precio_unitario.value = data.lista[0].precio_venta;
        stock.value = data.lista[0].cantidad;
        separar_miles(precio_unitario);
    }).catch(error => console.error(error));

}



