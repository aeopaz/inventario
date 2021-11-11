//Mostrar modal
$('.ver-modal').on('click', function(event){
    event.preventDefault();
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    const url=$(this).attr('href');
    const data={
        _token:csrfToken
    }
    ajaxRequest(data,url, 'verModal');

});

function ajaxRequest(data,url,funcion){
$.ajax({
    url:url,
    type: 'get',
    data:data,
    success: function(respuesta){
        //if(funcion == 'verModal'){
            $('#modal-show-modal .modal-body').html(respuesta)
            $('#modal-show-modal').modal('show');


        //}
    }

})
}

