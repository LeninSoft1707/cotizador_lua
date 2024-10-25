<?php 
// Incluye el autoload de Composer
require '../vendor/autoload.php';

// Importa las clases PHPMailer y Exception
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluye archivos de configuración y el modelo de Cotización
require_once("../config/conexion.php");
require_once("../models/Cotizacion.php");


class Email extends PHPMailer {
    protected $gmailUsername;
    protected $gmailPassword;
    protected $senderEmail;

    public function __construct() {
        parent::__construct();
        // Asigna directamente las credenciales
        $this->gmailUsername = 'lenin.soft2020@gmail.com'; // Aquí va tu dirección de Gmail
        $this->gmailPassword = 'ieogbkekhixagmmm'; // Aquí va tu contraseña de aplicación
        $this->senderEmail = 'lenin.ih.fis@hotmail.com'; // Aquí va tu correo remitente
    }

    public function envio_cotizacion($cot_id) {
        // Crea una instancia de la clase Cotizacion
        $cotizacion = new Cotizacion();
        $datos = $cotizacion->get_cotizacion($cot_id);
    
        foreach($datos as $row) {
            $cot_id = $row["cot_id"];
            $mes_texto = $row["mes_en_texto"];
            $fecha_larga = $row["fech_crea_format"];
    
            $xcli_nom = $row["cli_nom"];
            $xcli_ruc = $row["cli_ruc"];
            $xcli_telf = $row["cli_telf"];
            $xcli_email = $row["cli_email"];
            $xcon_nom = $row["con_nom"];
            $xcon_telf = $row["con_telf"];
            $xcon_email = $row["con_email"];
            
            $xemp_nom = $row["emp_nom"];
            $xemp_ruc = $row["emp_ruc"];
            $xemp_direc = $row["emp_direc"];
            $xusu_nom = $row["usu_nom"];
            $xusu_correo = $row["usu_correo"];
            $xemp_telf = $row["emp_telf"];
            $xemp_email = $row["emp_email"];
        }
    
        $datosd = $cotizacion->get_dcotizacion($cot_id, 'D');
        $tbody = "";
        foreach ($datosd as $rowd){
            $tbody .='
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                        <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                            <div class="u-col u-col-70p69" style="max-width: 320px;min-width: 353.43px;display: table-cell;vertical-align: top;">
                                <div style="background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                    <div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 66px 20px;font-family:arial,helvetica,sans-serif;" align="left">
                                                        <div style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                            <p style="font-size: 14px; line-height: 140%;"><span style="font-family: Montserrat, sans-serif; font-size: 14px; line-height: 19.6px;"><strong>'.$rowd["prod_nom"].'</strong><span style="color: #666666; font-size: 14px; line-height: 19.6px;">x'.$rowd["cotd_cant"].'</span></span></p>
                                                            <p style="font-size: 14px; line-height: 140%;"><span style="font-family: Montserrat, sans-serif; font-size: 14px; line-height: 19.6px;">'.$rowd["prod_descrip"].'</span></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="u-col u-col-29p31" style="max-width: 320px;min-width: 146.57px;display: table-cell;vertical-align: top;">
                                <div style="background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                    <div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 66px 20px;font-family:arial,helvetica,sans-serif;" align="left">
                                                        <div style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                            <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-family: Montserrat, sans-serif; font-size: 16px; line-height: 22.4px;">'.$rowd["cotd_precio"].'</span></strong></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

        // Configuración del servidor SMTP de Gmail
        $this->isSMTP();
        $this->Host = 'smtp.gmail.com';
        $this->Port = 587;
        $this->SMTPAuth = true;
        $this->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        
        // Credenciales de Gmail
        $this->Username = $this->gmailUsername;
        $this->Password = $this->gmailPassword;

        // Establecer el remitente del correo
        $this->setFrom($this->senderEmail, 'Eventos y Decoraciones LUA, Cotizacion Nro: '.$cot_id);

        // Configuración de la codificación de caracteres.
        $this->CharSet = 'UTF-8'; // Establece la codificación de caracteres a UTF-8.
        $this->addAddress($xcli_email); // Agrega la dirección de correo del destinatario.
        $this->isHTML(true); // Indica que el cuerpo del correo es HTML.
        $this->Subject = "Nueva Cotizacion"; // Define el asunto del correo.

        // Carga el contenido HTML del cuerpo del correo desde un archivo.
        $cuerpo = file_get_contents('../assets/NuevaCotizacion.html'); // Asegúrate de que la ruta del archivo sea correcta.

        // Reemplazar marcadores en el contenido HTML
        $cuerpo = str_replace("t_mes_escrito", $mes_texto, $cuerpo);
        $cuerpo = str_replace("t_fecha_larga", $fecha_larga, $cuerpo);

        $cuerpo = str_replace("t_cot_id", $cot_id, $cuerpo);
        
        $cuerpo = str_replace("t_nrocotizacion", $cot_id, $cuerpo);
        $cuerpo = str_replace("t_cli_nom", $xcli_nom, $cuerpo);
        $cuerpo = str_replace("t_cli_ruc", $xcli_ruc, $cuerpo);
        $cuerpo = str_replace("t_cli_telf", $xcli_telf, $cuerpo);
        $cuerpo = str_replace("t_cli_email", $xcli_email, $cuerpo);

        $cuerpo = str_replace("t_con_nom", $xcon_nom, $cuerpo);
        $cuerpo = str_replace("t_con_telf", $xcon_telf, $cuerpo);
        $cuerpo = str_replace("t_con_email", $xcon_email, $cuerpo);
        $cuerpo = str_replace("t_emp_nom", $xemp_nom, $cuerpo);
        $cuerpo = str_replace("t_emp_ruc", $xemp_ruc, $cuerpo);
        $cuerpo = str_replace("t_emp_direc", $xemp_direc, $cuerpo);
        $cuerpo = str_replace("t_usu_nom", $xusu_nom, $cuerpo);
        $cuerpo = str_replace("t_usu_correo", $xusu_correo, $cuerpo);
        $cuerpo = str_replace("t_emp_telf", $xemp_telf, $cuerpo);
        $cuerpo = str_replace("t_emp_email", $xemp_email, $cuerpo);
        $cuerpo = str_replace("t_listadodetalle", $tbody, $cuerpo);

        $cuerpo = str_replace("t_cotiruta", "http://localhost:90/PERSONAL_COTIZADOR/view/ViewCotizacion?id=".$cot_id, $cuerpo);

        $this->Body = $cuerpo; // Asigna el cuerpo del correo.
        $this->AltBody = strip_tags("Nueva Cotizacion"); // Establece un cuerpo alternativo sin HTML.

        $this->SMTPDebug = 0; // Establece el nivel de depuración: 0 = desactivado, 1 = errores y mensajes, 2 = mensajes detallados
        $this->Debugoutput = 'html'; // Salida de depuración como HTML
        try {
            // Intenta enviar el correo.
            $this->send(); // Si se envía correctamente, retorna verdadero.
            return true;
        } catch(Exception $e) {
            // Si ocurre un error, retorna falso.
            echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$this->ErrorInfo}";
            return false; // Aquí podrías manejar el error de manera más detallada si lo deseas.
        }
    }

    public function visto_cotizacion($cot_id) {
        // Crea una instancia de la clase Cotizacion
        $cotizacion = new Cotizacion();
        $datos = $cotizacion->get_cotizacion($cot_id);
    
        foreach($datos as $row) {
            $cot_id = $row["cot_id"];
            $mes_texto = $row["mes_en_texto"];
            $fecha_larga = $row["fech_crea_format"];
    
            $xcli_nom = $row["cli_nom"];
            $xcli_ruc = $row["cli_ruc"];
            $xcli_telf = $row["cli_telf"];
            $xcli_email = $row["cli_email"];
            $xcon_nom = $row["con_nom"];
            $xcon_telf = $row["con_telf"];
            $xcon_email = $row["con_email"];
            
            $xemp_nom = $row["emp_nom"];
            $xemp_ruc = $row["emp_ruc"];
            $xemp_direc = $row["emp_direc"];
            $xusu_nom = $row["usu_nom"];
            $xusu_correo = $row["usu_correo"];
            $xemp_telf = $row["emp_telf"];
            $xemp_email = $row["emp_email"];
        }
    
        $datosd = $cotizacion->get_dcotizacion($cot_id, 'D');
        $tbody = "";
        foreach ($datosd as $rowd){
            $tbody .='
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                        <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                            <div class="u-col u-col-70p69" style="max-width: 320px;min-width: 353.43px;display: table-cell;vertical-align: top;">
                                <div style="background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                    <div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 66px 20px;font-family:arial,helvetica,sans-serif;" align="left">
                                                        <div style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                            <p style="font-size: 14px; line-height: 140%;"><span style="font-family: Montserrat, sans-serif; font-size: 14px; line-height: 19.6px;"><strong>'.$rowd["prod_nom"].'</strong><span style="color: #666666; font-size: 14px; line-height: 19.6px;">x'.$rowd["cotd_cant"].'</span></span></p>
                                                            <p style="font-size: 14px; line-height: 140%;"><span style="font-family: Montserrat, sans-serif; font-size: 14px; line-height: 19.6px;">'.$rowd["prod_descrip"].'</span></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="u-col u-col-29p31" style="max-width: 320px;min-width: 146.57px;display: table-cell;vertical-align: top;">
                                <div style="background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                    <div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 66px 20px;font-family:arial,helvetica,sans-serif;" align="left">
                                                        <div style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                            <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-family: Montserrat, sans-serif; font-size: 16px; line-height: 22.4px;">'.$rowd["cotd_precio"].'</span></strong></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

        // Configuración del servidor SMTP de Gmail
        $this->isSMTP();
        $this->Host = 'smtp.gmail.com';
        $this->Port = 587;
        $this->SMTPAuth = true;
        $this->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        
        // Credenciales de Gmail
        $this->Username = $this->gmailUsername;
        $this->Password = $this->gmailPassword;

        // Establecer el remitente del correo
        $this->setFrom($this->senderEmail, '(Visto)'.$xcli_nom.', Cotizacion Nro: '.$cot_id);

        // Configuración de la codificación de caracteres.
        $this->CharSet = 'UTF-8'; // Establece la codificación de caracteres a UTF-8.
        $this->addAddress($xusu_correo); // Agrega la dirección de correo del destinatario.
        $this->isHTML(true); // Indica que el cuerpo del correo es HTML.
        $this->Subject = "Visto Cotizacion"; // Define el asunto del correo.

        // Carga el contenido HTML del cuerpo del correo desde un archivo.
        $cuerpo = file_get_contents('../assets/VistoCotizacion.html'); // Asegúrate de que la ruta del archivo sea correcta.

        // Reemplazar marcadores en el contenido HTML
        $cuerpo = str_replace("t_mes_escrito", $mes_texto, $cuerpo);
        $cuerpo = str_replace("t_fecha_larga", $fecha_larga, $cuerpo);

        $cuerpo = str_replace("t_cot_id", $cot_id, $cuerpo);
        
        $cuerpo = str_replace("t_nrocotizacion", $cot_id, $cuerpo);
        $cuerpo = str_replace("t_cli_nom", $xcli_nom, $cuerpo);
        $cuerpo = str_replace("t_cli_ruc", $xcli_ruc, $cuerpo);
        $cuerpo = str_replace("t_cli_telf", $xcli_telf, $cuerpo);
        $cuerpo = str_replace("t_cli_email", $xcli_email, $cuerpo);

        $cuerpo = str_replace("t_con_nom", $xcon_nom, $cuerpo);
        $cuerpo = str_replace("t_con_telf", $xcon_telf, $cuerpo);
        $cuerpo = str_replace("t_con_email", $xcon_email, $cuerpo);
        $cuerpo = str_replace("t_emp_nom", $xemp_nom, $cuerpo);
        $cuerpo = str_replace("t_emp_ruc", $xemp_ruc, $cuerpo);
        $cuerpo = str_replace("t_emp_direc", $xemp_direc, $cuerpo);
        $cuerpo = str_replace("t_usu_nom", $xusu_nom, $cuerpo);
        $cuerpo = str_replace("t_usu_correo", $xusu_correo, $cuerpo);
        $cuerpo = str_replace("t_emp_telf", $xemp_telf, $cuerpo);
        $cuerpo = str_replace("t_emp_email", $xemp_email, $cuerpo);
        $cuerpo = str_replace("t_listadodetalle", $tbody, $cuerpo);

        $cuerpo = str_replace("t_cotiruta", "http://localhost:90/PERSONAL_COTIZADOR/view/VistoCotizacion?id=".$cot_id, $cuerpo);

        $this->Body = $cuerpo; // Asigna el cuerpo del correo.
        $this->AltBody = strip_tags("Visto Cotizacion"); // Establece un cuerpo alternativo sin HTML.

        $this->SMTPDebug = 0; // Establece el nivel de depuración: 0 = desactivado, 1 = errores y mensajes, 2 = mensajes detallados
        $this->Debugoutput = 'html'; // Salida de depuración como HTML
        try {
            // Intenta enviar el correo.
            $this->send(); // Si se envía correctamente, retorna verdadero.
            return true;
        } catch(Exception $e) {
            // Si ocurre un error, retorna falso.
            echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$this->ErrorInfo}";
            return false; // Aquí podrías manejar el error de manera más detallada si lo deseas.
        }
    }

    public function respuesta_cotizacion($cot_id, $cot_tipo) {
        // Crea una instancia de la clase Cotizacion
        $cotizacion = new Cotizacion();
        $datos = $cotizacion->get_cotizacion($cot_id);
    
        foreach($datos as $row) {
            $cot_id = $row["cot_id"];
            $mes_texto = $row["mes_en_texto"];
            $fecha_larga = $row["fech_crea_format"];
    
            $xcli_nom = $row["cli_nom"];
            $xcli_ruc = $row["cli_ruc"];
            $xcli_telf = $row["cli_telf"];
            $xcli_email = $row["cli_email"];
            $xcon_nom = $row["con_nom"];
            $xcon_telf = $row["con_telf"];
            $xcon_email = $row["con_email"];
            
            $xemp_nom = $row["emp_nom"];
            $xemp_ruc = $row["emp_ruc"];
            $xemp_direc = $row["emp_direc"];
            $xusu_nom = $row["usu_nom"];
            $xusu_correo = $row["usu_correo"];
            $xemp_telf = $row["emp_telf"];
            $xemp_email = $row["emp_email"];
        }
    
        $datosd = $cotizacion->get_dcotizacion($cot_id, 'D');
        $tbody = "";
        foreach ($datosd as $rowd){
            $tbody .='
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                        <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                            <div class="u-col u-col-70p69" style="max-width: 320px;min-width: 353.43px;display: table-cell;vertical-align: top;">
                                <div style="background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                    <div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 66px 20px;font-family:arial,helvetica,sans-serif;" align="left">
                                                        <div style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                            <p style="font-size: 14px; line-height: 140%;"><span style="font-family: Montserrat, sans-serif; font-size: 14px; line-height: 19.6px;"><strong>'.$rowd["prod_nom"].'</strong><span style="color: #666666; font-size: 14px; line-height: 19.6px;">x'.$rowd["cotd_cant"].'</span></span></p>
                                                            <p style="font-size: 14px; line-height: 140%;"><span style="font-family: Montserrat, sans-serif; font-size: 14px; line-height: 19.6px;">'.$rowd["prod_descrip"].'</span></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="u-col u-col-29p31" style="max-width: 320px;min-width: 146.57px;display: table-cell;vertical-align: top;">
                                <div style="background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                    <div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 66px 20px;font-family:arial,helvetica,sans-serif;" align="left">
                                                        <div style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                            <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-family: Montserrat, sans-serif; font-size: 16px; line-height: 22.4px;">'.$rowd["cotd_precio"].'</span></strong></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

        // Configuración del servidor SMTP de Gmail
        $this->isSMTP();
        $this->Host = 'smtp.gmail.com';
        $this->Port = 587;
        $this->SMTPAuth = true;
        $this->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        
        // Credenciales de Gmail
        $this->Username = $this->gmailUsername;
        $this->Password = $this->gmailPassword;

        // Establecer el remitente del correo
        $this->setFrom($this->senderEmail, '('.$cot_tipo.')'.$xcli_nom.', Cotizacion Nro: '.$cot_id);

        // Configuración de la codificación de caracteres.
        $this->CharSet = 'UTF-8'; // Establece la codificación de caracteres a UTF-8.
        $this->addAddress($xusu_correo); // Agrega la dirección de correo del destinatario.
        $this->addAddress($xcli_email); // Agrega la dirección de correo del destinatario.
        $this->isHTML(true); // Indica que el cuerpo del correo es HTML.
        $this->Subject = "Respuesta Cotizacion"; // Define el asunto del correo.

        // Carga el contenido HTML del cuerpo del correo desde un archivo.
        $cuerpo = file_get_contents('../assets/RespuestaCotizacion.html'); // Asegúrate de que la ruta del archivo sea correcta.

        // Reemplazar marcadores en el contenido HTML
        $cuerpo = str_replace("t_mes_escrito", $mes_texto, $cuerpo);
        $cuerpo = str_replace("t_fecha_larga", $fecha_larga, $cuerpo);

        $cuerpo = str_replace("t_cot_id", $cot_id, $cuerpo);
        
        $cuerpo = str_replace("t_nrocotizacion", $cot_id, $cuerpo);
        $cuerpo = str_replace("t_cli_nom", $xcli_nom, $cuerpo);
        $cuerpo = str_replace("t_cli_ruc", $xcli_ruc, $cuerpo);
        $cuerpo = str_replace("t_cli_telf", $xcli_telf, $cuerpo);
        $cuerpo = str_replace("t_cli_email", $xcli_email, $cuerpo);

        $cuerpo = str_replace("t_con_nom", $xcon_nom, $cuerpo);
        $cuerpo = str_replace("t_con_telf", $xcon_telf, $cuerpo);
        $cuerpo = str_replace("t_con_email", $xcon_email, $cuerpo);
        $cuerpo = str_replace("t_emp_nom", $xemp_nom, $cuerpo);
        $cuerpo = str_replace("t_emp_ruc", $xemp_ruc, $cuerpo);
        $cuerpo = str_replace("t_emp_direc", $xemp_direc, $cuerpo);
        $cuerpo = str_replace("t_usu_nom", $xusu_nom, $cuerpo);
        $cuerpo = str_replace("t_usu_correo", $xusu_correo, $cuerpo);
        $cuerpo = str_replace("t_emp_telf", $xemp_telf, $cuerpo);
        $cuerpo = str_replace("t_emp_email", $xemp_email, $cuerpo);

        $cuerpo = str_replace("t_xrpta", $cot_tipo, $cuerpo);

        $cuerpo = str_replace("t_listadodetalle", $tbody, $cuerpo);

        $this->Body = $cuerpo; // Asigna el cuerpo del correo.
        $this->AltBody = strip_tags("Respuesta Cotizacion"); // Establece un cuerpo alternativo sin HTML.

        $this->SMTPDebug = 0; // Establece el nivel de depuración: 0 = desactivado, 1 = errores y mensajes, 2 = mensajes detallados
        $this->Debugoutput = 'html'; // Salida de depuración como HTML
        try {
            // Intenta enviar el correo.
            $this->send(); // Si se envía correctamente, retorna verdadero.
            return true;
        } catch(Exception $e) {
            // Si ocurre un error, retorna falso.
            echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$this->ErrorInfo}";
            return false; // Aquí podrías manejar el error de manera más detallada si lo deseas.
        }
    }
}
?>


