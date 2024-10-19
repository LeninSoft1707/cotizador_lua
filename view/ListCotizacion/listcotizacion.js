var tabla;

function init(){

}

$(document).ready(function(){
    var usu_id = $('#xusu_id').val();

    tabla=$('#lista_data').dataTable({ 
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
        url:'../../controller/cotizacion.php?op=listarporusuario',
        type : "post",
        data: {usu_id: usu_id},
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

function verfecha(cot_id){

    $.post("../../controller/cotizacion.php?op=mostrar", {cot_id: cot_id}, function(data) {
        data = JSON.parse(data);

        console.log(data);

        // Mostrar Fecha de Creación solo si no es null
        if (data.fech_crea_format_hms !== null) {
            $('#l_fech_crea_hms').html("<strong>Fecha de Creación: </strong>" + data.fech_crea_format_hms);
        } else {
            $('#l_fech_crea_hms').html(''); // Limpia el contenido si es null
        }

        // Mostrar Fecha de Envío solo si no es null
        if (data.fech_envio_format !== null) {
            $('#l_fech_envio_format').html("<strong>Fecha de Envio: </strong>" + data.fech_envio_format);
        } else {
            $('#l_fech_envio_format').html(''); // Limpia el contenido si es null
        }

        // Mostrar Fecha de Visto solo si no es null
        if (data.fech_visto_format !== null) {
            $('#l_fech_visto_format').html("<strong>Fecha de Visto: </strong>" + data.fech_visto_format);
        } else {
            $('#l_fech_visto_format').html(''); // Limpia el contenido si es null
        }

        // Verificar el tipo de cotización para mostrar Aceptado o Rechazado
        if (data.cot_tipo == 'Aceptado') {
            if (data.fech_respuesta_format !== null) {
                $('#l_fech_respuesta').html(
                    "<div class='card border-0 bg-success text-white text-start'>" +
                    "<div class='card-body p-2'>" +
                    "<blockquote class='blockquote mb-0' style='border:none'>" +
                    "<p><strong>Fecha de Aceptado: </strong> " + data.fech_respuesta_format + "</p>" +
                    "</blockquote>" +
                    "</div>" +
                    "</div>"
                );
            } else {
                $('#l_fech_respuesta').html(''); // Limpia el contenido si es null
            }
        } else {
            if (data.fech_respuesta_format !== null) {
                $('#l_fech_respuesta').html(
                    "<div class='card border-0 bg-danger text-white text-start'>" +
                    "<div class='card-body p-2'>" +
                    "<blockquote class='blockquote mb-0' style='border:none'>" +
                    "<p><strong>Fecha de Rechazado: </strong> " + data.fech_respuesta_format + "</p>" +
                    "</blockquote>" +
                    "</div>" +
                    "</div>"
                );
            } else {
                $('#l_fech_respuesta').html(''); // Limpia el contenido si es null
            }
        }

        // Mostrar el modal solo si hay fechas válidas
        if (data.fech_crea_format_hms || data.fech_envio_format || data.fech_visto_format || data.fech_respuesta_format !== null) {
            $('#mdlmnt').modal('show');
        }

        // $('#l_fech_crea_hms').html("<strong>Fecha de Creación: </strong>"+data.fech_crea_format_hms);
        // $('#l_fech_envio_format').html("<strong>Fecha de Envio: </strong>"+data.fech_envio_format);
        // $('#l_fech_visto_format').html("<strong>Fecha de Visto: </strong>"+data.fech_visto_format);

        // if(data.cot_tipo=='Aceptado'){
        //     $('#l_fech_respuesta').html(
        //         "<div class='card border-0 bg-success text-white text-start'>"+
        //         "<div class='card-body p-2'>"+
        //             "<blockquote class='blockquote mb-0' style='border:none'>"+
        //                 "<p><strong>Fecha de Aceptado: </strong> "+data.fech_respuesta_format+"</p>"+
        //             "</blockquote>"+
        //         "</div>"+
        //     "</div>"
        //     ); 
        // }else {
        //     $('#l_fech_respuesta').html(
        //         "<div class='card border-0 bg-danger text-white text-start'>"+
        //         "<div class='card-body p-2'>"+
        //             "<blockquote class='blockquote mb-0' style='border:none'>"+
        //                 "<p><strong>Fecha de Rechazado: </strong> "+data.fech_respuesta_format+"</p>"+
        //             "</blockquote>"+
        //         "</div>"+
        //     "</div>"
        //     ); 
        // }   
        // $('#mdlmnt').modal('show');
    });
    


}

init();