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
        url: "../../controller/producto.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            var data = JSON.parse(datos);  // Parsear la respuesta para manejar los casos
            // TODO: Resetear el formulario
            if (data.status === 'ok'){
                $('#mnt_form')[0].reset();

                // TODO: Ocultar el modal
                $("#mdlmnt").modal('hide');

                // TODO: Recargar la tabla de datos
                $('#lista_data').DataTable().ajax.reload();

            // TODO: Mostrar mensaje de éxito usando SweetAlert
                Swal.fire({
                    title: '¡Producto!',
                    text: 'El registro se ha Guardado y/o Actualizado correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            } else if (data.status === 'error'){
                // TODO: Mostrar alerta de duplicidad usando SweetAlert
                Swal.fire({
                    title: 'Advertencia',
                    text: 'El producto ya existe. Por favor, elija un nombre diferente.',
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

function editar(prod_id){ 
    
    $('#mdltitulo').html('Editar Registro');

    $.post("../../controller/producto.php?op=mostrar", {prod_id: prod_id}, function(data){
        data = JSON.parse(data);
        $('#prod_id').val(data.prod_id);
        $('#cat_id').val(data.cat_id).trigger("change");
        $('#prod_nom').val(data.prod_nom);
        $('#prod_descrip').val(data.prod_descrip);
        $('#prod_precio').val(data.prod_precio);
    });
    /*mostrar en modal*/
    $('#mdlmnt').modal('show');

}


function eliminar(prod_id){
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
                $.post("../../controller/producto.php?op=eliminar", {prod_id: prod_id}, function(data){

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
            }, 2000); // Esperar 2 segundos (2000ms)

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

$(document).ready(function() {
        // Inicializa Select2 en el select con id 'car_id'
        
        $.post("../../controller/categoria.php?op=combo", function(data, status) {
            $('#cat_id').html(data);
        });
        
    // Inicialización de la tabla de datos (por si la necesitas también)
        tabla = $('#lista_data').dataTable({
            "aProcessing": true,
            "aServerSide": true,
            dom: 'Bfrtip',
            "searching": true,
            lengthChange: false,
            colReorder: true,
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "ajax": {
                url: '../../controller/producto.php?op=listar',
                type: "post",
                dataType: "json",
                error: function(e) {
                    console.log(e.responseText);
                }
            },
            "bDestroy": true,
            "responsive": true,
            "bInfo": true,
            "iDisplayLength": 10,
            "autoWidth": false,
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sInfo": "Mostrando un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando un total de 0 registros",
                "sInfoFiltered": "(Filtrado de un total de _MAX_ registros)",
                "sLoadingRecords": "Cargando...",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        }).DataTable();
    });


$(document).on("click","#btnnuevo",function(){
    $('#mnt_form')[0].reset();
    $('#mdltitulo').html('Nuevo Producto');
    $('#mdlmnt').modal('show');

});

init();