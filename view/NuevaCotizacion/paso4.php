<div class="container-fluid py-2">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                                <h6 class="text-white text-capitalize ps-3">Paso 4</h6>
                                <button class="btn btn-light btn-sm me-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFieldset4" aria-expanded="false" aria-controls="collapseFieldset">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="collapse show" id="collapseFieldset4">
                            <div class="container py-5">
                                <!-- Datos de la empresa -->
                                <div class="row mb-4 text-center">
                                    <div class="col">
                                        <h2 id="v_emp_nom">Eventos & Decoraciones LUA </h2>
                                        <label id="v_emp_ruc" style="margin-left: 0; font-size: 1.5rem !important"></label><br>
                                        <label id="v_emp_direc" style="margin-left: 0; font-size: 1rem !important"></label><br>
                                        <label id="v_emp_telf" style="margin-left: 0; font-size: 1rem !important"></label>
                                        <span style="margin: 0 10px; border-left: 1px solid #303030; height: 1rem;"></span>
                                        <label id="v_emp_email" style="margin-left: 0; font-size: 1rem !important"></label>
                                    </div>
                                </div>
                                
                                <!-- Datos del cliente y cotización -->
                                <div class="container px-3">
                                    <div class="row mb-4">
                                            <div class="col-md-6">
                                                <h6>Datos del Cliente:</h6>
                                                <h4><strong id="v_cli_nom"></strong></h4>
                                                <label id="v_cli_ruc" style="margin-left: 0; font-size: 1rem !important"></label><br>
                                                <label id="v_cli_email" style="margin-left: 0; font-size: 1rem !important"></label><br>
                                                <label id="v_cli_telf" style="margin-left: 0; font-size: 1rem !important"></label>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 id="v_mes_en_texto"></h6>
                                                <h4><strong id="v_fech_crea_format"></strong></h4> 
                                                <label style="margin-left: 0; font-size: 1rem !important">Número de Cotización: </label><strong id="v_cot_id"></strong><br>
                                                <label style="margin-left: 0; font-size: 1rem !important">Cotizador: </label><strong id="v_usu_nom"></strong> 
                                            </div>
                                    </div>
                                </div>
                                <!-- Descripción y Tabla 1 -->
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="ps-2">Descripción de los Servicios</h5>
                                        <p>
                                            <textarea class="form-control text-justify" rows="4" id="v_cot_saludo" name="v_cot_saludo">Adjunto encontrará nuestra propuesta de cotización para los productos y/o servicios que hemos conversado. Este documento incluye una descripción detallada de los servicios, precios y condiciones que ofrecemos. Por favor, revise la información y no dude en contactarnos si tiene alguna pregunta o si necesita más detalles. Agradecemos su interés en nuestra empresa y esperamos poder colaborar con usted para satisfacer sus necesidades.</textarea>
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
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="invoice">
                                    <div class="invoice-content">
                                        <div class="invoice-price py-0">
                                            <div class="invoice-price-left">
                                                <!-- <div class="invoice-price-row">
                                                    <div class="sub-price">
                                                        <span class="text-label">Sub Total</span>
                                                        <span class="text-inverse" id="cot_subtotal">S/. 0.00</span>
                                                    </div>
                                                    <div class="sub-price">
                                                        <i class="fa fa-plus text-muted"></i>
                                                    </div>
                                                    <div class="sub-price">
                                                        <span class="text-label">Profit (20%)</span>
                                                        <span class="text-inverse" id="cot_profit">S/. 0.00</span>
                                                    </div>
                                                </div>       -->
                                            </div>
                                            <div class="invoice-price-right">
                                                <small>TOTAL</small>
                                                <span class="f-w-600" id="v_cot_subtotal">S/. 0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Descripción y Tabla 2 Costos Adicionales -->
                                <div id="list_adicionales_mostrar">
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h6 class="ps-2">Lista de Precios de los Productos/Servicios Adicionales</h6>
                                            <p>
                                                <textarea class="form-control text-justify" rows="1" id="v_cot_adicional" name="v_cot_adicional">Adjunto encontrará nuestra lista de precios de los productos y/o servicios adicionales que ofrecemos NO INCLUIDOS en la cotizacion inicial:</textarea>
                                            </p>
                                            
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
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="invoice-note px-2">
                                    * Precio incluido el IGV <br>
                                    * Cotización válido por 7 dias.
                                </div>

                                <div class="invoice-content">
                                    <!-- <p id="v_cot_contrato" name="cot_contrato">
                                            
                                        <h3 class="text-center">CONTRATO DE PRESTACIÓN DE SERVICIOS</h3>
                                        
                                        
                                        <h4 class="text-center">CONTRATO DE PRESTACIÓN DE SERVICIOS DE EVENTOS SOCIALES Y/O ACADÉMICOS</h4>
                                        
                                       
                                        <p class="text-justify">
                                            QUE CELEBRAN POR UNA PARTE LA REPRESENTANTE DE LA EMPRESA, LUISA INOCENTE HINOJOSA – “EVENTOS & DECORACIONES LUA”, ADMINISTRADA POR LUISA INOCENTE HINOJOSA, IDENTIFICADA CON DNI Nº 47942529, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ “PRESTADOR DEL SERVICIO”, Y POR LA OTRA PARTE, <strong class="text-uppercase" id="v_cli_nom4"></strong>, IDENTIFICADO(A) CON <strong id="v_cli_ruc3"></strong>, CEL Nro. <strong id="v_cli_telf3"></strong>, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ “CLIENTE”, ALTENOR DE LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS.
                                        </p>
                                        
                                        
                                        <ol>
                                            <li class="text-justify">
                                            <strong>PRIMERO.-</strong> “EL CLIENTE”, contrata los servicios de CATERING Y DECORACIÓN para la celebración del evento social BODA CIVIL y verificación durante el mismo día, para lo cual contará con la supervisión del “PRESTADOR DEL SERVICIO”. La descripción del servicio se detalla a continuación:
                                            
                                                <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="text-left px-2">Producto / Servicio</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">Precio Unitario</th>
                                                            <th class="text-center">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="v_tabla_detalle3">
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
                                            <strong>CUARTO.-</strong> El costo total del servicio es de <strong id="v_cot_total3"></strong>. Al momento de la firma del presente contrato se otorgará un adelanto de <strong>S/6000.00</strong> y la cancelación de <strong>S/1310.00</strong> sera antes de iniciar el evento.
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
                                        
                                        
                                        <div class="invoice-price py-0">
                                            <p class="text-left mt-4">
                                                
                                            </p>
                                            <p class="text-right mt-4">
                                                Pichanaki, <strong id="v_fech_crea_format3"></strong>.
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
                                            <p><strong class="text-uppercase" id="v_cli_nom5"></strong></p>
                                            <p><strong id="v_cli_ruc4"></p>
                                            </div>
                                        </div>
                                    </p> -->
                                    
                                    <textarea class="form-control text-justify" rows="48" id="v_cot_contrato" name="v_cot_contrato">
                                    CONTRATO DE PRESTACIÓN DE SERVICIOS

CONTRATO DE PRESTACIÓN DE SERVICIOS DE EVENTOS SOCIALES Y/O ACADÉMICOS

QUE CELEBRAN POR UNA PARTE LA REPRESENTANTE DE LA EMPRESA, LUISA INOCENTE HINOJOSA – “EVENTOS & DECORACIONES LUA”, ADMINISTRADA POR LUISA INOCENTE HINOJOSA, IDENTIFICADA CON DNI Nº 47942529, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ “PRESTADOR DEL SERVICIO”, Y POR LA OTRA PARTE, **[CLIENTE]**, IDENTIFICADO(A) CON **[RUC]**, CEL Nro. **[TELÉFONO]**, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ “CLIENTE”, ALTENOR DE LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS.

1. PRIMERO.- “EL CLIENTE”, contrata los servicios de CATERING Y DECORACIÓN para la celebración del evento social BODA CIVIL y verificación durante el mismo día, para lo cual contará con la supervisión del “PRESTADOR DEL SERVICIO”. La descripción del servicio se detalla a continuación:

Producto / Servicio        Cantidad    Precio Unitario   Total
Servicio 1                      2               $150.00             $300.00
Descripción detallada del Servicio 1, que incluye características y beneficios.
Servicio 2                      1               $200.00             $200.00
Descripción detallada del Servicio 2, que incluye características y beneficios.
Servicio 3                      3               $100.00             $300.00
Descripción detallada del Servicio 3, que incluye características y beneficios.

2. SEGUNDO.- Queda pactada la fecha del evento para el día 05 de octubre del 2024, con una duración total de 12 horas aproximadamente, de acuerdo a las características y especificaciones del anexo de este contrato.

3. TERCERO.- La locación del mencionado evento será en el local “PUERTO ARENA” en el (Jr. Av. Psje.) Puerto Pichanaki – Pichanaki – Chanchamayo - Junín.

4. CUARTO.- El costo total del servicio es de **[COSTO TOTAL]**. Al momento de la firma del presente contrato se otorgará un adelanto de S/6000.00 y la cancelación de S/1310.00 será antes de iniciar el evento.

5. QUINTO.- En caso de cancelación del evento, no hay opción a reembolso.

6. SEXTO.- Para la interpretación y cumplimiento del presente contrato, las partes se someten a la revisión y aceptación del contrato mediante firmas, tanto del prestador de servicios como del cliente. No habiendo más que consten sobre el presente documento y enteradas las partes de su alcance y contenido legal, lo suscriben.

7. SEPTIMO.- El local debe abastecer con suministro de energía no menor a 220V.

8. OCTAVO.- En caso de no realizar la cancelación, se detendrá el evento.

Pichanaki, **[FECHA DE CREACIÓN]**.

________________________                                             ________________________
LUISA INOCENTE HINOJOSA                                                     **[CLIENTE]**
DNI: 47942529                                                              **[RUC CLIENTE]**

                                    </textarea>
                                </div>

                                <!-- Redes Sociales -->
                                <div class="container mt-4">
                                    <div class="row text-center">
                                        <div class="col-12 d-flex justify-content-center flex-wrap">
                                            <div class="icon-text">
                                                <a href="#" class="me-2"><i class="fab fa-facebook fa-lg"></i></a>
                                                <span class="me-4" id="v_emp_web2"></span>
                                            </div>
                                            <div class="icon-text">
                                                <a href="#" class="me-2"><i class="fab fa-whatsapp fa-lg"></i></a>
                                                <span class="me-4" id="v_emp_telf2"></span>
                                            </div>
                                            <div class="icon-text">
                                                <a href="mailto:contacto@empresa.com" class="me-2"><i class="fas fa-envelope fa-lg"></i></a>
                                                <span id="v_emp_email2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row mt-4 text-center">
                                    <div class="col">
                                        <a href="#" class="me-3"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="me-3"><i class="fab fa-whatsapp fa-2x"></i></a>
                                        <a href="mailto:contacto@empresa.com"><i class="fas fa-envelope fa-2x"></i></a>
                                    </div>
                                </div> -->

                                <!-- Botones para imprimir y exportar a PDF -->
                                <div class="row mt-4 text-center">
                                    <div class="col">
                                        <button class="btn btn-primary me-2" onclick="printCotizacion()">Imprimir</button>
                                        <form action="exportar_pdf.php" method="POST" style="display: inline;">
                                            <button type="submit" class="btn btn-success">Exportar a PDF</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>


