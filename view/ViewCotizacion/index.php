<!DOCTYPE html>
<html lang="es_ES">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <!-- SweetAlert2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <title>
    Cotizacion_cliente
  </title>
  <?php require_once("../Html/Head.php") ?>

  <!-- Estilos Personalizados -->
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
      color: #333;
    }

    .invoice-content {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
    }

    .text-justify {
      text-align: justify;
    }

    .no-print {
      display: block;
    }

    /* Estilos para la impresión */
    @media print {
      body {
        -webkit-print-color-adjust: exact; /* Para conservar colores en Chrome */
        font-size: 12pt;
      }

      .no-print {
        display: none; /* Ocultar elementos con esta clase al imprimir */
      }

      .invoice-content {
        padding: 10px;
        page-break-inside: avoid;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      th,
      td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
      }

      .total-cost {
        background-color: #ffffff;
        border: 1px solid #000;
        padding: 10px;
        width: 100%;
        margin-top: 10px;
        float: none;
        text-align: right;
      }

      .page-break {
        page-break-before: always;
      }

      /* Asegurar que el contenido no tenga restricciones de altura */
      .main-content {
        height: auto !important;
        max-height: none !important;
        overflow: visible !important;
      }
    }

    /* Estilos Adicionales */
    .table-container {
      margin: 20px 0;
    }

    .service-description {
      font-size: 0.85rem;
      color: #555;
    }

    .invoice-note {
      font-size: 0.9rem;
      margin-top: 20px;
    }

    .icon-text a {
      color: #333;
      text-decoration: none;
    }

    .icon-text a:hover {
      color: #007bff;
    }

    /* Asegurar que el contenido principal no tenga restricciones de altura en pantalla */
    .main-content {
      max-height: none;
      height: auto;
      overflow: visible;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-200">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid">
      <div class="row">
        <!-- Navbar -->
        <div class="col-12">
          <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl no-print" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Página</a></li>
                  <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Eventos & Decoraciones LUA</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Cotizaciones</h6>
              </nav>
            </div>
          </nav>
        </div>

        <!-- Alerta -->
        <div id="v_alerta_respuesta">
        </div>
      </div>
    </div>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3 d-inline">Cotización Nro: <small id="v_cot_id">##</small></h6>
                  <!-- <h6 class="text-white text-capitalize ps-3 d-inline"><small>Rechazado</small></h6> -->
                  <span id="v_titulo_respuesta"></span>
              </div>
            </div>


            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <div class="container-fluid py-2">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="collapse show" id="collapseFieldset4">
                          <div class="container py-5">
                            <!-- Datos de la empresa -->
                            <div class="row mb-4 text-center">
                              <div class="col">
                                <h2 id="v_emp_nom">Eventos & Decoraciones LUA</h2>
                                <label id="v_emp_ruc" style="font-size: 1.5rem !important">RUC: 12345678900</label><br>
                                <label id="v_emp_direc" style="font-size: 1rem !important">Dirección de la Empresa</label><br>
                                <label id="v_emp_telf" style="font-size: 1rem !important">Teléfono: (123) 456-7890</label>
                                <span style="margin: 0 10px; border-left: 1px solid #303030; height: 1rem;"></span>
                                <label id="v_emp_email" style="font-size: 1rem !important">Email: contacto@empresa.com</label>
                              </div>
                            </div>

                            <!-- Datos del cliente y cotización -->
                            <div class="container px-3">
                              <div class="row mb-4">
                                <div class="col-md-6">
                                  <h6>Datos del Cliente:</h6>
                                  <h4><strong id="v_cli_nom"></strong></h4>
                                  <label id="v_cli_ruc" style="font-size: 1rem !important"></label><br>
                                  <label id="v_cli_email" style="font-size: 1rem !important"></label><br>
                                  <label id="v_cli_telf" style="font-size: 1rem !important"></label>
                                </div>
                                <div class="col-md-6">
                                  <h6 id="v_mes_en_texto">Descripción del Mes</h6>
                                  <h4><strong id="v_fech_crea_format">16 de octubre de 2024</strong></h4>
                                  <label style="font-size: 1rem !important">Número de Cotización: </label><strong id="v_cot_id2">#00</strong><br>
                                  <label style="font-size: 1rem !important">Cotizador: </label><strong id="v_usu_nom">Nombre del Usuario</strong>
                                </div>
                              </div>
                            </div>

                            <!-- Descripción y Tabla de Productos/Servicios -->
                            <div class="row">
                              <div class="col-12">
                                <h5 class="ps-2">Descripción de los Servicios</h5>
                                <p class="form-control text-justify" id="v_cot_saludo" name="v_cot_saludo">
                                  Saludo personalizado al cliente.
                                </p>
                                <div class="table-responsive">
                                  <table class="table table-bordered">
                                    <thead class="table-light">
                                      <tr>
                                        <th class="text-left px-2">Producto / Servicio</th>
                                        <th class="text-center">Cantidad</th>
                                        <!-- <th class="text-center">Precio Unitario</th> -->
                                        <th class="text-center">Total</th>
                                      </tr>
                                    </thead>
                                    <tbody id="v_tabla_detalle">
                                      <tr>
                                        <td>
                                          Servicio 1
                                          <div class="service-description">Descripción detallada del Servicio 1, que incluye características y beneficios.</div>
                                        </td>
                                        <td class="text-center">2</td>
                                        <td class="text-center">$150.00</td>
                                        <td class="text-center">$300.00</td>
                                      </tr>
                                      <tr>
                                        <td>
                                          Servicio 2
                                          <div class="service-description">Descripción detallada del Servicio 2, que incluye características y beneficios.</div>
                                        </td>
                                        <td class="text-center">1</td>
                                        <td class="text-center">$200.00</td>
                                        <td class="text-center">$200.00</td>
                                      </tr>
                                      <tr>
                                        <td>
                                          Servicio 3
                                          <div class="service-description">Descripción detallada del Servicio 3, que incluye características y beneficios.</div>
                                        </td>
                                        <td class="text-center">3</td>
                                        <td class="text-center">$100.00</td>
                                        <td class="text-center">$300.00</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <!-- Costo Total -->
                            <div class="invoice">
                              <div class="invoice-content">
                                <div class="invoice-price py-0">
                                  <div class="invoice-price-left">
                                    <!-- <small>TOTAL</small>
                                    <span class="f-w-600" id="v_cot_total">S/. 800.00</span> -->
                                  </div>
                                  <div class="invoice-price-right">
                                    <small>TOTAL</small>
                                    <span class="f-w-600" id="v_cot_subtotal2">S/. 800.00</span>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- Costos Adicionales -->
                            <div id="list_adicionales_mostrar">
                              <div class="row mt-4">
                                <div class="col-12">
                                  <h6 class="ps-2">Lista de Precios de los Productos/Servicios Adicionales</h6>
                                  <p class="form-control text-justify" rows="1" id="v_cot_adicional" name="v_cot_adicional">Descripción de los costos adicionales.</p>

                                  <div class="table-responsive">
                                    <table class="table table-bordered">
                                      <thead class="table-light">
                                        <tr>
                                          <th class="text-left px-2">Producto / Servicio - Adicional</th>
                                          <th class="text-center">Cantidad</th>
                                          <!-- <th class="text-center">Precio Unitario</th> -->
                                          <th class="text-center">Total</th>
                                        </tr>
                                      </thead>
                                      <tbody id="v_tabla_detalle_a">
                                        <tr>
                                          <td>
                                            Producto Adicional 1
                                            <div class="service-description">Descripción del Producto Adicional 1.</div>
                                          </td>
                                          <td class="text-center">1</td>
                                          <td class="text-center">$50.00</td>
                                          <td class="text-center">$50.00</td>
                                        </tr>
                                        <!-- Más filas según sea necesario -->
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- Notas sobre la Cotización -->
                            <div class="invoice-note px-2">
                              <p>* Precio incluido el IGV</p>
                              <p>* Cotización válida por 7 días.</p>
                            </div>

                            <!-- Contrato -->
                            <div class="invoice-content">
                                <!-- Título Principal -->
                                <h3 class="text-center">CONTRATO DE PRESTACIÓN DE SERVICIOS</h3>
                                
                                <!-- Subtítulo -->
                                <h4 class="text-center">CONTRATO DE PRESTACIÓN DE SERVICIOS DE EVENTOS SOCIALES Y/O ACADÉMICOS</h4>
                                
                                <!-- Introducción -->
                                <p class="text-justify">
                                    QUE CELEBRAN POR UNA PARTE LA REPRESENTANTE DE LA EMPRESA, LUISA INOCENTE HINOJOSA – “EVENTOS & DECORACIONES LUA”, ADMINISTRADA POR LUISA INOCENTE HINOJOSA, IDENTIFICADA CON DNI Nº 47942529, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ “PRESTADOR DEL SERVICIO”, Y POR LA OTRA PARTE, <strong class="text-uppercase" id="v_cli_nom2"></strong>, IDENTIFICADO(A) CON <strong id="v_cli_ruc2"></strong>, CEL Nro. <strong id="v_cli_telf2"></strong>, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ “CLIENTE”, ALTENOR DE LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS.
                                </p>
                                
                                <!-- Cláusulas -->
                                <ol>
                                    <li class="text-justify">
                                    <strong>PRIMERO.-</strong> “EL CLIENTE”, contrata los servicios de CATERING Y DECORACIÓN para la celebración del evento social BODA CIVIL y verificación durante el mismo día, para lo cual contará con la supervisión del “PRESTADOR DEL SERVICIO”. La descripción del servicio se detalla a continuación:
                                    <!-- Tabla de Servicios -->
                                        <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-light">
                                            <tr>
                                                <th class="text-left px-2">Producto / Servicio</th>
                                                <th class="text-center">Cantidad</th>
                                                <!-- <th class="text-center">Precio Unitario</th> -->
                                                <th class="text-center">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody id="v_tabla_detalle2">
                                            <tr>
                                                <td>
                                                Servicio 1
                                                <div class="service-description">Descripción detallada del Servicio 1, que incluye características y beneficios.</div>
                                                </td>
                                                <td class="text-center">2</td>
                                                <td class="text-center">$150.00</td>
                                                <td class="text-center">$300.00</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                Servicio 2
                                                <div class="service-description">Descripción detallada del Servicio 2, que incluye características y beneficios.</div>
                                                </td>
                                                <td class="text-center">1</td>
                                                <td class="text-center">$200.00</td>
                                                <td class="text-center">$200.00</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                Servicio 3
                                                <div class="service-description">Descripción detallada del Servicio 3, que incluye características y beneficios.</div>
                                                </td>
                                                <td class="text-center">3</td>
                                                <td class="text-center">$100.00</td>
                                                <td class="text-center">$300.00</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    </li>
                                    <li class="text-justify">
                                    <strong>SEGUNDO.-</strong> Queda pactada la fecha del evento para el día <strong>05 de octubre del 2024</strong>, con una duración total de <strong>12 horas aproximadamente</strong>, de acuerdo a las características y especificaciones del anexo de este contrato.
                                    </li>
                                    <li class="text-justify">
                                    <strong>TERCERO.-</strong> La locación del mencionado evento será en el local “PUERTO ARENA” en el (Jr. Av. Psje.) Puerto Pichanaki – Pichanaki – Chanchamayo - Junín.
                                    </li>
                                    <li class="text-justify">
                                    <strong>CUARTO.-</strong> El costo total del servicio es de <strong id="v_cot_subtotal3"></strong>(<span id="v_cot_subtotal_letras"></span>). Al momento de la firma del presente contrato se otorgará un adelanto de <strong>S/6000.00</strong> y la cancelación de <strong>S/1310.00</strong> sera antes de iniciar el evento.
                                    </li>
                                    <li class="text-justify">
                                    <strong>QUINTO.-</strong> En caso de cancelación del evento, no hay opción a reembolso.
                                    </li>
                                    <li class="text-justify">
                                    <strong>SEXTO.-</strong> Para la interpretación y cumplimiento del presente contrato, las partes se someten a la revisión y aceptación del contrato mediante firmas, tanto del prestador de servicios como del cliente. No habiendo más que consten sobre el presente documento y enteradas las partes de su alcance y contenido legal, lo suscriben.
                                    </li>
                                    <li class="text-justify">
                                    <strong>SEPTIMO.-</strong> El local debe abastecer con suministro de energía no menor a 220V.
                                    </li>
                                    <li class="text-justify">
                                    <strong>OCTAVO.-</strong> En caso de no realizar la cancelación, se detendrá el evento.
                                    </li>
                                </ol>
                                
                                <!-- Fecha y Firmas -->
                                <div class="invoice-price py-0">
                                    <p class="text-left mt-4">
                                        <!-- Pichanaki, 12 del mes de Setiembre del 2024. -->
                                    </p>
                                    <p class="text-right mt-4">
                                        Pichanaki, <strong id="v_fech_crea_format2"></strong>.
                                    </p>
                                </div>
                                
                                <div class="row mt-5">
                                    <div class="col-6 text-center">
                                    <p>________________________</p>
                                    <p>LUISA INOCENTE HINOJOSA</p>
                                    <p>DNI: 47942529</p>
                                    </div>
                                    <div class="col-6 text-center">
                                    <p>________________________</p>
                                    <p><strong class="text-uppercase" id="v_cli_nom3"></strong></p>
                                    <p><strong id="v_cli_ruc3"></p>
                                    </div>
                                </div>
                              </div>

                              <!-- Div para ocultar los botones y el check cuando ya se acepto o rechazo la cotizacion -->
                              <div id="v_aceptadorechazado">
                                <!-- Checkbox para aceptar términos y condiciones -->
                                <div class="row mt-4 text-center">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="aceptarTerminos">
                                            <label class="form-check-label" for="aceptarTerminos">
                                                Acepto los <a href="#" class="text-primary">términos y condiciones</a>.
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones para aceptar o rechazar la cotización -->
                                <div class="row mt-4 text-center no-print">
                                    <div class="col">
                                        <button id="btnAceptar" class="btn btn-success me-2" disabled>Aceptar Cotización</button>
                                        <button id="btnRechazar" class="btn btn-danger me-2" disabled>Rechazar Cotización</button>
                                    </div>
                                </div>
                              </div> 

                              <!-- Redes Sociales -->
                              <div class="container mt-4">
                                <div class="row text-center">
                                  <div class="col-12 d-flex justify-content-center flex-wrap">
                                    <div class="icon-text me-4">
                                      <a href="#" class="me-2"><i class="fab fa-facebook fa-lg"></i></a>
                                      <span id="v_emp_web2">www.ejemplo.com</span>
                                    </div>
                                    <div class="icon-text me-4">
                                      <a href="#" class="me-2"><i class="fab fa-whatsapp fa-lg"></i></a>
                                      <span id="v_emp_telf2">+51 123 456 789</span>
                                    </div>
                                    <div class="icon-text">
                                      <a href="mailto:contacto@empresa.com" class="me-2"><i class="fas fa-envelope fa-lg"></i></a>
                                      <span id="v_emp_email2">contacto@empresa.com</span>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            <!-- Botones para imprimir y exportar a PDF -->
                            <div class="row mt-4 text-center no-print">
                              <div class="col">
                                <button class="btn btn-primary me-2" onclick="printCotizacion()">Imprimir</button>
                                <button class="btn btn-warning me-2" onclick="descargarPDF()">Exportar a PDF</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Footer -->
          <footer class="footer py-4 no-print">
            <div class="container-fluid">
              <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                  <div class="copyright text-center text-sm text-muted text-lg-start">
                    © <script>
                      document.write(new Date().getFullYear())
                    </script>,
                    made with <i class="fa fa-heart"></i> by
                    <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                    for a better web.
                  </div>
                </div>
                <div class="col-lg-6">
                  <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                      <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                    </li>
                    <!-- Más enlaces -->
                  </ul>
                </div>
              </div>
            </div>
          </footer>
          <!-- End Footer -->
        </div>
      </main>

      <!-- Core JS Files -->
      <?php require_once("../Html/js.php") ?>

      <!-- jQuery (Debe estar incluido antes de viewcotizacion.js si lo usas) -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <!-- Tu archivo JavaScript -->
      <script type="text/javascript" src="viewcotizacion.js"></script>

      <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
          var options = {
            damping: '0.5'
          }
          Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        // Función para imprimir la cotización
        function printCotizacion() {
          window.print();
        }

        // Función para descargar la cotización como PDF usando html2pdf.js
        function descargarPDF() {
          const element = document.querySelector('.card.my-4'); // Ajusta el selector según tu estructura
          const opt = {
            margin:       10,
            filename:     'Cotizacion.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
          };

          // Incluye html2pdf.js desde un CDN
          const script = document.createElement('script');
          script.src = "https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js";
          script.onload = () => {
            html2pdf().set(opt).from(element).save();
          };
          document.body.appendChild(script);
        }

        // Funciones para Minimizar y Maximizar el Panel
        let panelMinimizado = false;

        function togglePanel() {
          const panelContent = document.getElementById("panel-content");
          const minimizeButton = document.getElementById("minimize-button");

          if (!panelMinimizado) {
            panelContent.style.display = "none"; // Oculta el contenido del panel
            minimizeButton.innerHTML = "&#x2B;"; // Cambia el icono a maximizar
            panelMinimizado = true;
          } else {
            panelContent.style.display = "block"; // Muestra el contenido del panel
            minimizeButton.innerHTML = "&#x2212;"; // Cambia el icono a minimizar
            panelMinimizado = false;
          }
        }
      </script>

      <!-- SweetAlert2 JS -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>

    </html>

