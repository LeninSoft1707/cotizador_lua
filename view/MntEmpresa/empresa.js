var tabla;

function init(){
    // TODO: Evento para enviar el formulario cuando se hace submit
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
        url: "../../controller/empresa.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            var data = JSON.parse(datos);  // Parsear la respuesta para manejar los casos
            // TODO: Resetear el formulario
            if (data.status === 'ok'){
                // TODO: Resetear el formulario
                $('#mnt_form')[0].reset();

                // TODO: Ocultar el modal
                $("#mdlmnt").modal('hide');

                // TODO: Recargar la tabla de datos
                $('#lista_data').DataTable().ajax.reload();

                // TODO: Mostrar mensaje de éxito usando SweetAlert
                Swal.fire({
                    title: '¡Empresa!',
                    text: 'El registro se ha Guardado y/o Actualizado correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            }else if (data.status === 'error'){
                // TODO: Mostrar mensaje de error en caso de fallo
                Swal.fire({
                    title: 'Advertencia',
                    text: 'La empresa ya existe',
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

function editar(emp_id) {
    $('#mdltitulo').html('Editar Registro');

    // TODO: Obtener los datos de la empresa a editar mediante una solicitud AJAX
    $.post("../../controller/empresa.php?op=mostrar", {emp_id: emp_id}, function(data) {
        data = JSON.parse(data);
        $('#emp_id').val(data.emp_id);
        $('#emp_nom').val(data.emp_nom);
        $('#emp_porcen').val(data.emp_porcen);
    });

    // TODO: Mostrar el modal de edición
    $('#mdlmnt').modal('show');
}

function eliminar(emp_id) {
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
            // TODO: Mostrar el modal de espera por 3 segundos
            Swal.fire({
                title: 'Procesando...',
                html: 'Espere un momento...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // TODO: Simular espera de 1 segundo antes de continuar con la eliminación
            setTimeout(() => {
                // TODO: Realiza la solicitud AJAX para eliminar el registro
                $.post("../../controller/empresa.php?op=eliminar", {emp_id: emp_id}, function(data) {
                    // TODO: Recargar la tabla después de la eliminación
                    $('#lista_data').DataTable().ajax.reload();

                    // TODO: Mostrar la confirmación de eliminación
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
                });
            }, 1000); // Esperar 1 segundo (1000ms)

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
}

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
        url:'../../controller/empresa.php?op=listar',
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

$(document).on("click", "#btnnuevo", function() {
    // TODO: Resetear el formulario para un nuevo registro
    $('#mnt_form')[0].reset();
    $('#mdltitulo').html('Nueva Empresa');
    $('#mdlmnt').modal('show');
});

init();
