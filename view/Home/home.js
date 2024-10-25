$(document).ready(function() {

    $.ajax({
        url: "../../controller/cotizacion.php?op=totalcotizaciones",
        type: "GET",
        dataType: "json",
        beforeSend: function() {

        },
        success: function(data) {
            $("#lbltotalcotizaciones").html(data.total);
        },
        error: function(){

        }
        
    })

    $.ajax({
        url: "../../controller/cotizacion.php?op=totalaceptada",
        type: "GET",
        dataType: "json",
        beforeSend: function() {

        },
        success: function(data) {
            $("#lblaceptados").html(data.total);
        },
        error: function(){

        }
        
    })

    $.ajax({
        url: "../../controller/cotizacion.php?op=totalrechazada",
        type: "GET",
        dataType: "json",
        beforeSend: function() {

        },
        success: function(data) {
            $("#lblrechazados").html(data.total);
        },
        error: function(){

        }
        
    })

    $.ajax({
        url: "../../controller/cotizacion.php?op=totalvista",
        type: "GET",
        dataType: "json",
        beforeSend: function() {

        },
        success: function(data) {
            $("#lblvistos").html(data.total);
        },
        error: function(){

        }
        
    })

    $.ajax({
        url: "../../controller/cotizacion.php?op=totalenviado",
        type: "GET",
        dataType: "json",
        beforeSend: function() {

        },
        success: function(data) {
            $("#lblenviados").html(data.total);
        },
        error: function(){

        }
        
    })

    $.ajax({
        url: '../../controller/cotizacion.php?op=totalaceptadausuario',
        type: 'GET',  // El método está bien si estás usando POST en tu controlador.
        dataType: 'json',
        success: function(response) {
            // Asegurarse de que la respuesta tenga datos y crear el gráfico
            if (response && response.labels && response.totales) {
                aceptadoGrafico(response.labels, response.totales);
            } else {
                console.log('No se recibieron datos válidos.');
            }
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });

    $.ajax({
        url: '../../controller/cotizacion.php?op=totalrechazadausuario',
        type: 'GET',  // El método está bien si estás usando POST en tu controlador.
        dataType: 'json',
        success: function(response) {
            // Asegurarse de que la respuesta tenga datos y crear el gráfico
            if (response && response.labels && response.totales) {
                rechazadoGrafico(response.labels, response.totales);
            } else {
                console.log('No se recibieron datos válidos.');
            }
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });

    $.ajax({
        url: '../../controller/cotizacion.php?op=totalvistousuario',
        type: 'GET',  // El método está bien si estás usando POST en tu controlador.
        dataType: 'json',
        success: function(response) {
            // Asegurarse de que la respuesta tenga datos y crear el gráfico
            if (response && response.labels && response.totales) {
                vistoGrafico(response.labels, response.totales);
            } else {
                console.log('No se recibieron datos válidos.');
            }
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });

    $.ajax({
        url: '../../controller/cotizacion.php?op=totalenviadausuario',
        type: 'GET',  // El método está bien si estás usando POST en tu controlador.
        dataType: 'json',
        success: function(response) {
            // Asegurarse de que la respuesta tenga datos y crear el gráfico
            if (response && response.labels && response.totales) {
                enviadoGrafico(response.labels, response.totales);
            } else {
                console.log('No se recibieron datos válidos.');
            }
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });

    //MUESTRA EL PORCENTAJE DE COTIZACIONES
    $.ajax({
        url: '../../controller/cotizacion.php?op=porcentajecotizaciones', // Asegúrate de que esta URL sea correcta
        type: 'GET',
        dataType: 'json',
        beforeSend: function() {
            // Puedes mostrar un spinner o un mensaje de carga si lo deseas
        },
        success: function(data) {

            // Asegúrate de usar los nombres correctos de las propiedades y verifica si son números
            $("#porcentajeAceptadas").html((!isNaN(data.porcentajeAceptada) ? parseFloat(data.porcentajeAceptada).toFixed(2) : '0') + '%');
            $("#porcentajeRechazadas").html((!isNaN(data.porcentajeRechazada) ? parseFloat(data.porcentajeRechazada).toFixed(2) : '0') + '%');
            $("#porcentajeVistas").html((!isNaN(data.porcentajeVista) ? parseFloat(data.porcentajeVista).toFixed(2) : '0') + '%');
            $("#porcentajeEnviadas").html((!isNaN(data.porcentajeEnviada) ? parseFloat(data.porcentajeEnviada).toFixed(2) : '0') + '%');
            
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error en la solicitud AJAX: " + textStatus, errorThrown);
        }
    });
    
    
    


    function aceptadoGrafico(labels, totales) {
        // Obtener el contexto del lienzo donde se va a dibujar el gráfico
        var ctx = document.getElementById('graficoAceptados').getContext('2d');
        
        // Crear el gráfico
        new Chart(ctx, {
            type: 'bar', // Tipo de gráfico de barras
            data: {
                labels: labels, // Nombres de los comercios (empresas)
                datasets: [{
                    label: 'Total Aceptados',
                    data: totales, // Totales de cotizaciones aceptadas por comercio
                    backgroundColor: 'rgba(255, 255, 255, 0.8)', // Color de las barras (blanco)
                    borderColor: 'rgba(255, 255, 255, 1)', // Borde de las barras (blanco)
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            color: 'white' // Color de las etiquetas del eje X
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.25)', // Color de las líneas de la cuadrícula del eje X
                            borderDash: [5, 5] // Líneas entrecortadas: 5px de línea, 5px de espacio
                        }
                    },
                    y: {
                        beginAtZero: true, // Comenzar el eje Y en 0
                        ticks: {
                            color: 'white' // Color de las etiquetas del eje Y
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.25)', // Color de las líneas de la cuadrícula del eje Y
                            borderDash: [5, 5] // Líneas entrecortadas: 5px de línea, 5px de espacio
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' // Color de las etiquetas de la leyenda
                        }
                    }
                }
            }
        });
    }

    function rechazadoGrafico(labels, totales) {
        // Obtener el contexto del lienzo donde se va a dibujar el gráfico
        var ctx = document.getElementById('graficoRechazados').getContext('2d');
        
        // Crear el gráfico
        new Chart(ctx, {
            type: 'bar', // Tipo de gráfico de barras
            data: {
                labels: labels, // Nombres de los comercios (empresas)
                datasets: [{
                    label: 'Total Rechazados',
                    data: totales, // Totales de cotizaciones aceptadas por comercio
                    backgroundColor: 'rgba(255, 255, 255, 0.8)', // Color de las barras (blanco)
                    borderColor: 'rgba(255, 255, 255, 1)', // Borde de las barras (blanco)
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            color: 'white' // Color de las etiquetas del eje X
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.25)', // Color de las líneas de la cuadrícula del eje X
                            borderDash: [5, 5] // Líneas entrecortadas: 5px de línea, 5px de espacio
                        }
                    },
                    y: {
                        beginAtZero: true, // Comenzar el eje Y en 0
                        ticks: {
                            color: 'white' // Color de las etiquetas del eje Y
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.25)', // Color de las líneas de la cuadrícula del eje Y
                            borderDash: [5, 5] // Líneas entrecortadas: 5px de línea, 5px de espacio
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' // Color de las etiquetas de la leyenda
                        }
                    }
                }
            }
        });
    }

    function vistoGrafico(labels, totales) {
        // Obtener el contexto del lienzo donde se va a dibujar el gráfico
        var ctx = document.getElementById('graficoVistos').getContext('2d');
        
        // Crear el gráfico
        new Chart(ctx, {
            type: 'bar', // Tipo de gráfico de barras
            data: {
                labels: labels, // Nombres de los comercios (empresas)
                datasets: [{
                    label: 'Total Vistos',
                    data: totales, // Totales de cotizaciones aceptadas por comercio
                    backgroundColor: 'rgba(255, 255, 255, 0.8)', // Color de las barras (blanco)
                    borderColor: 'rgba(255, 255, 255, 1)', // Borde de las barras (blanco)
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            color: 'white' // Color de las etiquetas del eje X
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.25)', // Color de las líneas de la cuadrícula del eje X
                            borderDash: [5, 5] // Líneas entrecortadas: 5px de línea, 5px de espacio
                        }
                    },
                    y: {
                        beginAtZero: true, // Comenzar el eje Y en 0
                        ticks: {
                            color: 'white' // Color de las etiquetas del eje Y
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.25)', // Color de las líneas de la cuadrícula del eje Y
                            borderDash: [5, 5] // Líneas entrecortadas: 5px de línea, 5px de espacio
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' // Color de las etiquetas de la leyenda
                        }
                    }
                }
            }
        });
    }

    function enviadoGrafico(labels, totales) {
        // Obtener el contexto del lienzo donde se va a dibujar el gráfico
        var ctx = document.getElementById('graficoEnviados').getContext('2d');
        
        // Crear el gráfico
        new Chart(ctx, {
            type: 'bar', // Tipo de gráfico de barras
            data: {
                labels: labels, // Nombres de los comercios (empresas)
                datasets: [{
                    label: 'Total Enviados',
                    data: totales, // Totales de cotizaciones aceptadas por comercio
                    backgroundColor: 'rgba(255, 255, 255, 0.8)', // Color de las barras (blanco)
                    borderColor: 'rgba(255, 255, 255, 1)', // Borde de las barras (blanco)
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            color: 'white' // Color de las etiquetas del eje X
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.25)', // Color de las líneas de la cuadrícula del eje X
                            borderDash: [5, 5] // Líneas entrecortadas: 5px de línea, 5px de espacio
                        }
                    },
                    y: {
                        beginAtZero: true, // Comenzar el eje Y en 0
                        ticks: {
                            color: 'white' // Color de las etiquetas del eje Y
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.25)', // Color de las líneas de la cuadrícula del eje Y
                            borderDash: [5, 5] // Líneas entrecortadas: 5px de línea, 5px de espacio
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' // Color de las etiquetas de la leyenda
                        }
                    }
                }
            }
        });
    }
    


});