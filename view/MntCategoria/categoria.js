var tabla;

function init(){
    $("#mnt_form").on("submit", function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e) {
    e.preventDefault();

    // TODO: Obtener los datos del formulario
    var formData = new FormData($("#mnt_form")[0]);

    // TODO: Enviar la solicitud AJAX
    $.ajax({
        url: "../../controller/categoria.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            var data = JSON.parse(datos);  // Parsear la respuesta para manejar los casos

            // TODO: Resetear el formulario si la operación es exitosa
            if (data.status === 'ok') {
                $('#mnt_form')[0].reset();
                $("#mdlmnt").modal('hide');
                $('#lista_data').DataTable().ajax.reload();  // Recargar la tabla de datos

                // TODO: Mostrar mensaje de éxito usando SweetAlert
                Swal.fire({
                    title: '¡Categoria!',
                    text: data.message,  // Mensaje enviado desde el servidor
                    icon: 'success',
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });

            } else if (data.status === 'error') {
                // TODO: Mostrar alerta de duplicidad usando SweetAlert
                Swal.fire({
                    title: 'Advertencia',
                    text: 'La categoría ya existe. Por favor, elija un nombre diferente.',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'btn btn-warning'
                    },
                    buttonsStyling: false
                });
            }
        },
        error: function(error) {
            // TODO: Manejar posibles errores
            console.error('Error al guardar o editar:', error);

            // TODO: Mostrar mensaje de error en caso de fallo
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al insertar el nuevo registro.',
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        }
    });
}


function editar(cat_id){ 
    $('#mdltitulo').html('Editar Registro');

    $.post("../../controller/categoria.php?op=mostrar", {cat_id: cat_id}, function(data){
        data = JSON.parse(data);
        $('#cat_id').val(data.cat_id);
        $('#cat_nom').val(data.cat_nom);
        $('#cat_descrip').val(data.cat_descrip);
    });
    /*mostrar en modal*/
    $('#mdlmnt').modal('show');

}

function eliminar(cat_id){
    swal.fire({
        title: "¿Estás Seguro?",
        text: "Esta seguro de Eliminar el registro",
        type: "error",
        icon: 'error',
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then((result) => {
        if (result.isConfirmed) {
            // Mostrar el modal de espera por 3 segundos
            Swal.fire({
                title: 'Procesando...',
                html: 'Espere un momento...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Simular espera de 3 segundos antes de continuar con la eliminación
            setTimeout(() => {
                // Realiza la solicitud AJAX para eliminar el registro
                $.post("../../controller/categoria.php?op=eliminar", {cat_id: cat_id}, function(data){

                });

                // Recarga la tabla después de la eliminación
                $('#lista_data').DataTable().ajax.reload();

                // Cerrar el modal de carga y mostrar la confirmación de eliminación
                Swal.fire({
                    title: 'Eliminado',
                    text: 'El registro ha sido eliminado.',
                    icon: 'success',
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            }, 1000); // Esperar 3 segundos (3000ms)

        }
    }).catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al eliminar el registro.',
            confirmButtonText: 'Ok',
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    });
};

$(document).ready(function(){
        tabla=$('#lista_data').dataTable({
    // tabla=$('#categoria_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching":true,
        lengthChange: false,
        colReorder: true,
        buttons: [
                 'copyHtml5',
                 'excelHtml5',
                'csvHtml5',
                 'pdfHtml5'
              ],
        "ajax":{
            url:'../../controller/categoria.php?op=listar',
            type : "post",
            dataType : "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo" : true,
        "iDisplayLength": 10,
        "autoWidth" : false,
        "language": {
            "sProcessing":      "Procesando...",
            "sLengthMenu":      "Mostrar _MENU_ registros",
            "sZeroRecords":     "No se encontraron resultados",
            "sInfo":            "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":       "Mostrando un total de 0 registros",
            "sInfoFiltered":    "(Filtrado de un total de _MAX_ registros",
            "sInfoPostFix":     "",
            "sSearch":          "Buscar",
            "sUrl":             "",
            "sInfoThousands":   ",",
            "sLoadingRecords":  "Cargando...",
            "oPaginate": {
                "sFirst":   "Primero",
                "sLast":    "Ultimo",
                "sNext":    "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":   ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending":  ": Activar para ordenar la columna de manera descendente"
            }
        }
    }).DataTable();
});


$(document).on("click","#btnnuevo",function(){
    $('#mnt_form')[0].reset();
    $('#mdltitulo').html('Nueva Categoria');
    $('#mdlmnt').modal('show');

});

init();