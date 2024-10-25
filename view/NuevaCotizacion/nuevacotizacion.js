$(document).ready(function() {
    // Inicializa Select2 en el select con id 'car_id'
    
    $.post("../../controller/cliente.php?op=combo", function(data, status) {
        $('#cli_id').html(data);
    });

    $.post("../../controller/categoria.php?op=combo", function(data, status) {
        $('#cat_id').html(data);
        $('#cat_id_a').html(data);
    });


    $("#cli_id").change(function(){
        $("#cli_id option:selected").each(function(){
            cli_id = $(this).val();

        $.post("../../controller/contacto.php?op=combo_x_cliente",{cli_id:cli_id},function(data){
            $('#con_id').html(data);
        });

        $.post("../../controller/cliente.php?op=mostrar",{cli_id:cli_id},function(data){
            data=JSON.parse (data);
            $('#cli_ruc').val(data.cli_ruc);

        });


        })
    });

    $("#cat_id").change(function(){
        $("#cat_id option:selected").each(function(){
            cat_id = $(this).val();

        $.post("../../controller/producto.php?op=combo_x_categoria",{cat_id:cat_id},function(data){
            $('#prod_id').html(data);
        });


        })
    });

    $("#cat_id_a").change(function(){
        $("#cat_id_a option:selected").each(function(){
            cat_id = $(this).val();

        $.post("../../controller/producto.php?op=combo_x_categoria",{cat_id:cat_id},function(data){
            $('#prod_id_a').html(data);
        });


        })
    });

    $("#con_id").change(function(){
    
        $("#con_id option:selected").each(function(){
            con_id = $(this).val();
            
            $.post("../../controller/contacto.php?op=mostrar",{con_id:con_id},function(data){
                data=JSON.parse (data);
                $('#con_telf').val(data.con_telf);
                $('#con_email').val(data.con_email);
    
            });
        })
    });

    $("#prod_id").change(function(){
    
        $("#prod_id option:selected").each(function(){
            prod_id = $(this).val();
            
            $.post("../../controller/producto.php?op=mostrar",{prod_id:prod_id},function(data){
                data=JSON.parse (data);
                $('#cotd_precio').val(data.prod_precio);
    
            });
        })
    });

    $("#prod_id_a").change(function(){
    
        $("#prod_id_a option:selected").each(function(){
            prod_id = $(this).val();
            
            $.post("../../controller/producto.php?op=mostrar",{prod_id:prod_id},function(data){
                data=JSON.parse (data);
                $('#cotd_precio_a').val(data.prod_precio);
    
            });
        })
    });
});

    //TODO: funcion para los botones de siguiente y anterior 

    $(document).on('click', '#nextBtn', function() {

        // TODO: Verifica si estamos en el paso 1 y si faltan datos en los campos del paso 1
        if (currentStep === 1) {
            if ($('#cli_id').val() === "" || $('#con_id').val() === "" || $('#cli_ruc').val() === "" || $('#con_telf').val() === "" || $('#con_email').val() === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Campos Vacios',
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
                return; // TODO: Detiene el avance si faltan datos en el paso 1
            }
        }

        // Validación para avanzar al siguiente paso
        if (currentStep === 2) {
            // Permitir avanzar si al menos un producto ha sido agregado, aunque los campos estén vacíos
            if (!productoAgregado && ($('#cat_id').val() === "" || $('#prod_id').val() === "" || $('#cotd_precio').val() === "" || $('#cotd_cant').val() === "")) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Campos Vacios',
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });

                return; // Detiene el avance si faltan datos en el paso 2 y no se ha agregado ningún producto
            }
        }
      

        // TODO: Si los datos están completos, guarda el borrador en la base de datos
        guardarBorrador();

        if (currentStep < totalSteps) {
            currentStep++; // Incrementa el contador de paso actual
            showStep(currentStep); // Muestra el siguiente paso
        } else if (currentStep === totalSteps) {
            // Muestra el cuadro de confirmación con Swal
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas enviar el correo?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, enviar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, envía el formulario y el correo
                    enviarFormulario(); 
                    enviarCorreo(); 
                    Swal.fire(
                        'Enviado',
                        'Tu correo han sido enviado con éxito.',
                        'success'
                    );
                } else {
                    // Opción cancelada
                    Swal.fire(
                        'Cancelado',
                        'El envío del formulario y el correo ha sido cancelado.',
                        'error'
                    );
                }
            });
        }
        
        
        // Verifica si estamos en el paso 4 y carga los datos del cliente
        if (currentStep === 4) {
            var cot_id = $('#cot_id').val();
            console.log(cot_id);

            $.post("../../controller/cotizacion.php?op=listara_vacio", {cot_id: cot_id, cotd_tipo:'A'}, function(data){
                if(data==0){
                    $('#list_adicionales_mostrar').hide();
                }else{
                    $('#list_adicionales_mostrar').show();
                }
    
            });

            $.post("../../controller/cotizacion.php?op=mostrar", {cot_id: cot_id}, function(data){
                data = JSON.parse(data);
                $('#v_cli_nom').html(data.cli_nom);
                $('#v_cli_nom4').html(data.cli_nom);//contrato CotizacionCliente
                $('#v_cli_nom5').html(data.cli_nom);//Firma contrato CotizacionCliente

                $('#v_cli_ruc').html("Ruc/Dni: "+data.cli_ruc);
                $('#v_cli_ruc3').html("Ruc/Dni: "+data.cli_ruc);//contrato CotizacionCliente
                $('#v_cli_ruc4').html("Ruc/Dni: "+data.cli_ruc);//Firma contrato CotizacionCliente
                $('#v_cli_email').html(data.cli_email);
                $('#v_cli_telf').html("Telf: "+data.cli_telf);
                $('#v_cli_telf3').html("Telf: "+data.cli_telf);//contrato CotizacionCliente

                $('#v_emp_nom').html(data.emp_nom);
                $('#v_emp_ruc').html("RUC: "+data.emp_ruc);
                $('#v_emp_direc').html("Dirección: "+data.emp_direc);
                $('#v_emp_telf').html("Telf: "+data.emp_telf);
                $('#v_emp_email').html("Email: "+data.emp_email);

                $('#v_mes_en_texto').html("Cotización / "+data.mes_en_texto);
                $('#v_fech_crea_format').html(" "+data.fech_crea_format);
                $('#v_fech_crea_format3').html(" "+data.fech_crea_format);//contrato CotizacionCliente
                $('#v_cot_id').html(" #00"+data.cot_id);
                $('#v_usu_nom').html(" "+data.usu_nom);

                $('#v_cot_total').html("S/. "+data.cot_total);
                $('#v_cot_subtotal').html("S/. "+data.cot_subtotal);
                $('#v_cot_total3').html("S/. "+data.cot_total);//contrato CotizacionCliente

                $('#v_emp_web2').html(data.emp_web);
                $('#v_emp_telf2').html("+051 "+data.emp_telf);
                $('#v_emp_email2').html(data.emp_email);

    
            });

            //Mostrar la lista de productos en la cotizacion paso 4 con detalle D
            $.post("../../controller/cotizacion.php?op=listarv", {cot_id: cot_id, cotd_tipo:'D'}, function(data){
                $('#v_tabla_detalle').html(data);
    
            });

            //Mostrar la lista de productos en el conttrato de cotizacion paso 4 con detalle D
            $.post("../../controller/cotizacion.php?op=listarv", {cot_id: cot_id, cotd_tipo:'D'}, function(data){
                $('#v_tabla_detalle3').html(data);
    
            });

            //Mostrar la lista de productos en la cotizacion paso 4 con detalle A
            $.post("../../controller/cotizacion.php?op=listarv", {cot_id: cot_id, cotd_tipo:'A'}, function(data){
                $('#v_tabla_detalle_a').html(data);
    
            });
            
            // //TODO: enviar la Info al correo del cliente
            // $.post("../../controller/email.php?op=envio", {cot_id: cot_id}, function(data){
            //     console.log(data);
    
            // });
        }

    });

    // TODO: Inicializa la variable que lleva el control del paso actual
    let currentStep = 1;
    // TODO: Define el número total de pasos
    const totalSteps = 4;

    function showStep(step) {
        // TODO: Oculta todo el contenido de pasos y muestra solo el contenido correspondiente al paso actual
        document.querySelectorAll('.step-content').forEach(content => {
            content.classList.remove('active');
        });
        document.getElementById(`step-${step}`).classList.add('active');

        // TODO: Cambia el texto del botón en función del paso actual
        const nextBtn = document.getElementById('nextBtn');
        nextBtn.textContent = step === totalSteps ? 'Enviar' : 'Siguiente';
    }

    //TODO: Funcion para guardar el cot_id del paso 1
    function guardarBorrador() {
        var cot_id = $('#cot_id').val(); // Mantén el valor del cot_id
        var usu_id = $('#xusu_id').val();// Manten el calor del usu_id
    
        // Solo genera el cot_id cuando pasas del paso 1 al paso 2, si aún no existe
        if (currentStep === 1 && !cot_id) {
            // Recoge los datos del paso 1
            var cli_id = $('#cli_id').val();
            var con_id = $('#con_id').val();
            var cli_ruc = $('#cli_ruc').val();
            var con_telf = $('#con_telf').val();
            var con_email = $('#con_email').val();
            var cot_descrip = $('#cot_descrip').val();
    
            // Enviar los datos al servidor para generar un nuevo cot_id
            $.ajax({
                type: 'POST',
                url: "../../controller/cotizacion.php?op=guardar",
                data: {
                    cli_id: cli_id,
                    con_id: con_id,
                    cli_ruc: cli_ruc,
                    con_telf: con_telf,
                    con_email: con_email,
                    cot_descrip: cot_descrip,
                    usu_id: usu_id
                },
                dataType: 'json',
                success: function(data) {
                    console.log('cot_id generado y guardado correctamente:', data);
                    $('#cot_id').val(data.cot_id); // Guarda el cot_id generado en el campo oculto
                },
                error: function(error) {
                    console.error('Error al generar cot_id:', error);
                }
            });
        }
    };

    //TODO: Funcion para enviar el formulario cuando estamos en el ultimo paso
    function enviarFormulario() {
        // Aquí puedes agregar la lógica para enviar el formulario
        
        // Envío del formulario usando AJAX, o puedes hacer un submit normal del formulario
        var cot_id = $('#cot_id').val();
        var cot_saludo = $('#v_cot_saludo').val();
        var cot_adicional = $('#v_cot_adicional').val();
        var cot_contrato = $('#v_cot_contrato').val();
        
        $.ajax({
            url: "../../controller/cotizacion.php?op=actualizar",
            type: "POST",
            data: {
                cot_id: cot_id,
                cot_saludo: cot_saludo,
                cot_adicional: cot_adicional,
                cot_contrato: cot_contrato
            },
            dataType: "json",
            success: function(response) {
                // Manejar la respuesta después de enviar la cotización
                Swal.fire({
                    icon: 'success',
                    title: 'Enviado',
                    text: 'Cotización enviada con éxito',
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            },
            error: function(xhr, status, error) {
                console.log("Error en la solicitud AJAX:", xhr.responseText);  // Muestra la respuesta del servidor
                console.log("Estado:", status);  // Muestra el estado del error
                console.log("Error:", error);  // Muestra el mensaje de error
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al enviar la cotización',
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
            }
        });
    }
    

    // TODO: Funcion para enviar el correo electronico al cliente
    // Función para enviar el correo al cliente
    function enviarCorreo() {
        var cot_id = $('#cot_id').val();
        
        // Verifica que cot_id no esté vacío
        if (cot_id) {
            $.post("../../controller/email.php?op=envio", { cot_id: cot_id }, function(data) {
                console.log(data);
                // Maneja la respuesta del servidor si es necesario
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'El correo ha sido enviado correctamente.',
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                }).then(function() {
                    // Añadimos una pequeña espera para asegurar el cierre del modal
                    setTimeout(function() {
                        window.location.assign("index.php"); // Cambia la ruta según tu proyecto
                    }, 500); 
                });
            }).fail(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo enviar el correo.',
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'ID de cotización no válido.',
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        }
    }
    
    $(document).on('click', '#prevBtn', function() {
        if (currentStep > 1) {
            currentStep--; // TODO: Disminuye el paso actual para retroceder
            showStep(currentStep); // TODO: Muestra el paso anterior
        }
    });

    // TODO: Mostrar el primer paso al cargar la página
    showStep(currentStep);

    //TODO: AGREGAR DETALLE DEL BOTON DEL PASO 2
    var productoAgregado = false; // Variable para verificar si se ha agregado un producto

    $(document).on('click', '#btnagregardetalle', function() {
        var cot_id = $('#cot_id').val();
        var cat_id = $('#cat_id').val();
        var prod_id = $('#prod_id').val();
        var cotd_precio = $('#cotd_precio').val();
        var cotd_cant = $('#cotd_cant').val();

        // Validar los campos antes de agregar el producto
        if(cat_id=="" || prod_id=="" || cotd_precio=="" || cotd_cant==""){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Campos Vacios',
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        } else {
            // Enviar datos a la base de datos
            $.ajax({
                type: 'POST',
                url: "../../controller/cotizacion.php?op=dguardar",
                data: {
                    cot_id: cot_id,
                    cat_id: cat_id,
                    prod_id: prod_id,
                    cotd_precio: cotd_precio,
                    cotd_cant: cotd_cant,
                    cotd_tipo: 'D',
                },
                dataType: 'json',
                success: function(data) {
                    listard(cot_id); // Actualiza la lista de productos

                    // Limpia los campos
                    $('#cat_id').val('');
                    $('#prod_id').val('');
                    $('#cotd_precio').val('');
                    $('#cotd_cant').val('');
                    $('#cotd_total').val('');

                    // Cambia el estado de la variable para permitir avanzar
                    productoAgregado = true;

                    // Mostrar notificación Gritter
                    $.gritter.add({
                        title: 'Producto agregado',
                        text: 'El producto se ha agregado correctamente.',
                        time: 3000, // Se cierra automáticamente después de 3 segundos
                        class_name: 'gritter-success' 
                    });
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo agregar el producto',
                        confirmButtonText: 'Ok',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                }
            });
        }
    });

    

    // TODO: AGREGAR DETALLE DEL BOTON DEL PASO 3
    $(document).on('click', '#btnagregardetalle_a', function() {
        var cot_id = $('#cot_id').val();
        var cat_id = $('#cat_id_a').val();
        var prod_id = $('#prod_id_a').val();
        var cotd_precio = $('#cotd_precio_a').val();
        var cotd_cant = $('#cotd_cant_a').val();

        if(cat_id=="" || prod_id=="" || cotd_precio=="" || cotd_cant==""){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Campos Vacios',
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        }else{
            console.log("Enviando datos a la base de datos:", {
                cot_id: cot_id,
                cat_id: cat_id,
                prod_id: prod_id,
                cotd_precio: cotd_precio,
                cotd_cant: cotd_cant
            });
            
            $.ajax({
                type: 'POST',
                url: "../../controller/cotizacion.php?op=dguardar",
                data: {
                    cot_id: cot_id,
                    cat_id: cat_id,
                    prod_id: prod_id,
                    cotd_precio: cotd_precio,
                    cotd_cant: cotd_cant,
                    cotd_tipo: 'A',
                },
                dataType: 'json',
                success: function(data) {

                    // $('#mdlcarga').modal('hide');
                    // $('#mdlmnt').modal('show');
                    listara(cot_id);
                    console.log("cotd_id" + data.cot_id);
                    
                },
                error: function(error) {
                    // $('#mdlcarga').modal('hide');
                }
            });

        }
    });

    // TODO: AGREGAR BOTON PARA GUARDAR EL EDITAR DEL PASO 2

    $(document).on('click', '#btnagregarmd', function() {
        var cot_id = $('#cot_id').val();
        var cotd_id = $('#cotd_id').val();
        var cotd_precio = $('#cotd_precio_md').val();
        var cotd_cant = $('#cotd_cant_md').val();
        var cotd_profit = $('#cotd_profit_md').val();

        if(cotd_id=="" || cotd_cant=="" || cotd_precio=="" || cotd_profit==""){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Campos Vacios',
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        }else{
            console.log("Enviando datos a la base de datos:", {
                cotd_id: cotd_id,
                cotd_precio: cotd_precio,
                cotd_cant: cotd_cant,
                cotd_profit: cotd_profit
            });
            
            $.ajax({
                type: 'POST',
                url: "../../controller/cotizacion.php?op=dactualizar",
                data: {
                    cotd_id: cotd_id,
                    cotd_precio: cotd_precio,
                    cotd_cant: cotd_cant,
                    cotd_profit: cotd_profit,
                    cot_id:cot_id
                },
                dataType: 'json',
                success: function(data) {

                    
                    // $('#mdlmnt').modal('show');
                    listard(cot_id);
                    listara(cot_id);
                    console.log("cotd_id" + data.cot_id);
                    $('#modald').modal('hide');
                },
                error: function(error) {
                    // $('#mdlcarga').modal('hide');
                }
            });

        }
    });

    //LISTAR PRODUCTOS DEL PASO 2
    function listard(cot_id){
        tabla = $('#detalle_data').dataTable({
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
                url: '../../controller/cotizacion.php?op=listard',
                type: "post",
                dataType: "json",
                data: {cot_id:cot_id, cotd_tipo:'D'},
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

        $('#mdltitulo').html('Editar Registro');

        $.post("../../controller/cotizacion.php?op=mostrar", {cot_id: cot_id}, function(data){
            data = JSON.parse(data);
            $('#cot_subtotal').html(data.cot_subtotal);
            $('#cot_profit').html(data.cot_profit);
            $('#cot_total').html(data.cot_total);

        });
    }

    //LISTAR ADICIONAL PARA PRODUCTOS DEL PASO 3
    function listara(cot_id){
        tabla = $('#detalle_data_a').dataTable({
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
                url: '../../controller/cotizacion.php?op=listard',
                type: "post",
                dataType: "json",
                data: {cot_id:cot_id, cotd_tipo:'A'},
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
    }
    //EDITAR PRODUCTOS DEL PASO 2
    function editard(cotd_id){
        console.log("Editar:"+ cotd_id)
        

        $('#mdltitulo').html('Editar Registro');

        $.post("../../controller/cotizacion.php?op=dmostrar", {cotd_id: cotd_id}, function(data){
            data = JSON.parse(data);
            $('#cotd_id').val(data.cotd_id);
            $('#cat_nom').val(data.cat_nom);
            $('#prod_nom').val(data.prod_nom);
            $('#cotd_precio_md').val(data.cotd_precio);
            $('#cotd_cant_md').val(data.cotd_cant);
            $('#cotd_profit_md').val(data.cotd_profit);
            $('#cotd_total_md').val(data.cotd_total);

        });
        /*mostrar en modal*/
        $('#modald').modal('show');
    }

    //FUNCION PARA ELIMINAR
    function eliminard(cotd_id){
        var cot_id = $('#cot_id').val();
        console.log("ID a eliminar:", cotd_id); // Esto debería mostrar el ID correcto
        $.ajax({
            type: 'POST',
            url: "../../controller/cotizacion.php?op=deliminar",
            data: {cotd_id: cotd_id, cot_id:cot_id},
            dataType: 'json',
            success: function(data) {
                console.log("Registro eliminado:", data);
                if (data.status === "success") {
                    
                    listard(cot_id); // Asegúrate de que esta línea se ejecuta
                    listara(cot_id);

                } else {
                    console.error("Error al eliminar:", data.message);
                }
                
            },
            error: function(error) {
                // $('#mdlcarga').modal('hide');
            }
        });
    }

    //FUNCION PARA MOSTRAR EL TOTAL AUTOMATICAMENTE EN EL PASO 2
    function calcularTotal() {
        var precio = parseFloat(document.getElementById('cotd_precio').value) || 0;
        var cantidad = parseFloat(document.getElementById('cotd_cant').value) || 0;
        var total = precio * cantidad;
        
        document.getElementById('cotd_total').value = total.toFixed(2); // Mostrar con dos decimales
    }
    
    // Escuchar cambios en los campos de precio y cantidad
    document.getElementById('cotd_precio').addEventListener('input', calcularTotal);
    document.getElementById('cotd_cant').addEventListener('input', calcularTotal);
    
    //FUNCION PARA MOSTRAR EL TOTAL AUTOMATICAMENTE EN EL PASO 3
    function calcularTotal_a() {
        var precio = parseFloat(document.getElementById('cotd_precio_a').value) || 0;
        var cantidad = parseFloat(document.getElementById('cotd_cant_a').value) || 0;
        var total = precio * cantidad;
        
        document.getElementById('cotd_total_a').value = total.toFixed(2); // Mostrar con dos decimales
    }
    
    // Escuchar cambios en los campos de precio y cantidad
    document.getElementById('cotd_precio_a').addEventListener('input', calcularTotal_a);
    document.getElementById('cotd_cant_a').addEventListener('input', calcularTotal_a);

    //FUNCION PARA MOSTRAR EL TOTAL AUTOMATICAMENTE EN EL MODAL DE PROFIT DEL PASO 2
    function calcularTotalMD() {    
        var precio = parseFloat(document.getElementById('cotd_precio_md').value) || 0;
        var cantidad = parseFloat(document.getElementById('cotd_cant_md').value) || 0;
        var profit = parseFloat(document.getElementById('cotd_profit_md').value) || 0;
        var total = (precio * cantidad) + profit;
        
        document.getElementById('cotd_total_md').value = total.toFixed(2); // Mostrar con dos decimales
    }
    
    // Escuchar cambios en los campos de cantidad y profit
    document.getElementById('cotd_precio_md').addEventListener('input', calcularTotalMD);
    document.getElementById('cotd_cant_md').addEventListener('input', calcularTotalMD);
    document.getElementById('cotd_profit_md').addEventListener('input', calcularTotalMD);









