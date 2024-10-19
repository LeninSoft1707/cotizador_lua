$(document).ready(function() {
    const url = window.location.href;
    const params = new URLSearchParams(new URL(url).search);
    const cot_id = params.get("id");

    if (!cot_id) {
        // Redirigir si el ID no está presente en la URL
        window.location.href = "../404/index.php";
        return;
    }

    // Verificar si la cotización existe
    $.post("../../controller/cotizacion.php?op=listara_vacio", {cot_id: cot_id, cotd_tipo: 'A'}, function(data) {
        if (data == 0) {
            $('#list_adicionales_mostrar').hide();
        } else {
            $('#list_adicionales_mostrar').show();
        }
    }).fail(function() {
        // Redirigir a la página de error si la solicitud falla
        window.location.href = "../404/index.php";
    });

    // Mostrar los detalles de la cotización
    $.post("../../controller/cotizacion.php?op=mostrar", {cot_id: cot_id}, function(data) {
            data = JSON.parse(data);

            if (data.error === "not_found") {
                // Si no encuentra el ID, redirige a la página 404
                window.location.href = "../404/index.php";  // Cambia la ruta si tu archivo 404.html está en otro lugar
            } else {

                $('#v_cli_nom').html(data.cli_nom);
                $('#v_cli_nom2').html(data.cli_nom);
                $('#v_cli_nom3').html(data.cli_nom);

                $('#v_cli_ruc').html("Ruc/Dni: " + data.cli_ruc);
                $('#v_cli_ruc2').html("RUC/DNI: " + data.cli_ruc);
                $('#v_cli_ruc3').html("RUC/DNI: " + data.cli_ruc);
                $('#v_cli_email').html(data.cli_email);
                $('#v_cli_telf').html("Telf: " + data.cli_telf);
                $('#v_cli_telf2').html(data.cli_telf);

                $('#v_emp_nom').html(data.emp_nom);
                $('#v_emp_ruc').html("RUC: " + data.emp_ruc);
                $('#v_emp_direc').html("Dirección: " + data.emp_direc);
                $('#v_emp_telf').html("Telf: " + data.emp_telf);
                $('#v_emp_email').html("Email: " + data.emp_email);

                $('#v_mes_en_texto').html("Cotización / " + data.mes_en_texto);
                $('#v_fech_crea_format').html(" " + data.fech_crea_format);
                $('#v_fech_crea_format2').html(" " + data.fech_crea_format);
                $('#v_cot_id').html(" #00" + data.cot_id);
                $('#v_cot_id2').html(" #00" + data.cot_id);
                $('#v_usu_nom').html(" " + data.usu_nom);

                $('#v_cot_total').html("S/. " + data.cot_total);
                $('#v_cot_subtotal2').html("S/. " + data.cot_subtotal);
                $('#v_cot_subtotal3').html("S/. " + data.cot_subtotal);
                $('#v_cot_subtotal_letras').html(numeroALetras(data.cot_subtotal));

                $('#v_emp_web2').html(data.emp_web);
                $('#v_emp_telf2').html("+051 " + data.emp_telf);
                $('#v_emp_email2').html(data.emp_email);

                $('#v_cot_saludo').html(data.cot_saludo);
                $('#v_cot_adicional').html(data.cot_adicional);
                $('#v_cot_contrato').html(data.cot_contrato);

                if(data.cot_tipo=='Visto'){

                }else if(data.cot_tipo=='Rechazado'){
                    $('#v_titulo_respuesta').html("<small class='text-sm alert alert-danger text-white text-uppercase'>Rechazado</small>");

                    $('#v_alerta_respuesta').html("<div class='col-12 px-4'><div class='alert alert-danger alert-dismissible text-white' role='alert'><span class='text-sm'>La Cotización fue Rechazada el: "+data.fech_respuesta_format+"</span><button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div></div>");
                }else if(data.cot_tipo=='Aceptado'){
                    $('#v_titulo_respuesta').html("<small class='text-sm alert alert-success text-white text-uppercase'>Aceptado</small>");

                    $('#v_alerta_respuesta').html("<div class='col-12 px-4'><div class='alert alert-success alert-dismissible text-white' role='alert'><span class='text-sm'>La Cotización fue Aceptada el: "+data.fech_respuesta_format+"</span><button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div></div>");
                }
            }
        });

    // Mostrar la lista de productos en la cotización paso 4 con detalle D
    $.post("../../controller/cotizacion.php?op=listarv", {cot_id: cot_id, cotd_tipo: 'D'}, function(data) {
        $('#v_tabla_detalle').html(data);
    });

    $.post("../../controller/cotizacion.php?op=listarv", {cot_id: cot_id, cotd_tipo: 'D'}, function(data) {
        $('#v_tabla_detalle2').html(data);
    });

    // Mostrar la lista de productos en la cotización paso 4 con detalle A
    $.post("../../controller/cotizacion.php?op=listarv", {cot_id: cot_id, cotd_tipo: 'A'}, function(data) {
        $('#v_tabla_detalle_a').html(data);
    });

    // Mostrar la fecha de visto de la cotizacion
    $.post("../../controller/cotizacion.php?op=actualizarvisto", {cot_id: cot_id}, function(data) {
    });

    // ocultar respuesta
    $.post("../../controller/cotizacion.php?op=ocultarrespuesta", {cot_id: cot_id}, function(data) {
        if(data==0){
            $('#v_aceptadorechazado').show();
        }else{
            $('#v_aceptadorechazado').hide();
        }
        
    });

    $('#aceptarTerminos').change(function(){
        if ($(this).is(':checked')) {
            $('#btnAceptar, #btnRechazar').prop('disabled', false);
        } else {
            $('#btnAceptar, #btnRechazar').prop('disabled', true);
        }
    })

    $(document).on("click", "#btnAceptar", function() {
        Swal.fire({
            title: "¿Estás Seguro?",
            text: "Está seguro de Aceptar la Cotización",
            icon: 'success',
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Sí, aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Mostrar el modal de espera mientras se procesa la solicitud
                Swal.fire({
                    title: 'Procesando...',
                    html: 'Espere un momento...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
    
                // Realiza la solicitud AJAX para actualizar la respuesta
                $.ajax({
                    url: "../../controller/cotizacion.php?op=actualizarrespuesta",
                    type: "POST",
                    data: {
                        cot_id: cot_id,  // Asegúrate de tener este valor disponible
                        cot_tipo: "Aceptado"
                    },
                    success: function(data) {
                        console.log(data); // Verifica la respuesta del servidor
    
                        // Cerrar el modal de carga y mostrar la confirmación
                        Swal.fire({
                            title: 'Aceptado',
                            text: 'La cotización ha sido aceptada.',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
    
                        // Opcional: Recarga la tabla después de la actualización
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown); // Manejo de errores
    
                        // Mostrar mensaje de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al aceptar la cotización.',
                            confirmButtonText: 'Ok',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }
                });
            }
        });
    });
    

    $(document).on("click", "#btnRechazar", function() {
        Swal.fire({
            title: "¿Estás Seguro?",
            text: "Está seguro de Rechazar la Cotización",
            icon: 'error',
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sí, rechazar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Mostrar el modal de espera mientras se procesa la solicitud
                Swal.fire({
                    title: 'Procesando...',
                    html: 'Espere un momento...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
    
                // Realiza la solicitud AJAX para actualizar la respuesta
                $.ajax({
                    url: "../../controller/cotizacion.php?op=actualizarrespuesta",
                    type: "POST",
                    data: {
                        cot_id: cot_id,
                        cot_tipo: "Rechazado"
                    },
                    success: function(data) {
                        console.log(data); // Verifica la respuesta del servidor
    
                        // Cerrar el modal de carga y mostrar la confirmación
                        Swal.fire({
                            title: 'Rechazado',
                            text: 'La cotización ha sido rechazada.',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
    
                        // Opcional: Recarga la tabla después de la actualización
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown); // Manejo de errores
    
                        // Mostrar mensaje de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al rechazar la cotización.',
                            confirmButtonText: 'Ok',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }
                });
            }
        });
    });
    

    // Función para convertir número a letras (español)
    function numeroALetras(num) {
        const unidades = ['Cero', 'Uno', 'Dos', 'Tres', 'Cuatro', 'Cinco', 'Seis', 'Siete', 'Ocho', 'Nueve'];
        const decenas = ['Diez', 'Veinte', 'Treinta', 'Cuarenta', 'Cincuenta', 'Sesenta', 'Setenta', 'Ochenta', 'Noventa'];
        const centenas = ['Cien', 'Doscientos', 'Trescientos', 'Cuatrocientos', 'Quinientos', 'Seiscientos', 'Setecientos', 'Ochocientos', 'Novecientos'];
        
        let letras = '';

        // Lógica para el número entero
        const entero = Math.floor(num);
        if (entero < 10) {
            letras = unidades[entero];
        } else if (entero < 100) {
            const dec = Math.floor(entero / 10);
            const unit = entero % 10;
            letras = decenas[dec - 1] + (unit > 0 ? ' y ' + unidades[unit] : '');
        } else if (entero < 1000) {
            const cent = Math.floor(entero / 100);
            const rest = entero % 100;
            letras = centenas[cent - 1] + (rest > 0 ? ' ' + numeroALetras(rest) : '');
        }

        // Manejo de los centavos
        const centavos = Math.round((num - entero) * 100);
        if (centavos >= 0) {
            letras += ` y ${centavos}/100 soles`;
        } else {
            letras += ' soles';
        }

        return letras.charAt(0).toUpperCase() + letras.slice(1); // Capitaliza la primera letra
    }
    
});
