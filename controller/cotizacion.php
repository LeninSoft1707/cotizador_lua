<?php 

    require_once("../config/conexion.php");
    require_once("../models/Cotizacion.php");
    require_once("../models/Email.php");

    $cotizacion = new Cotizacion();
    $email = new Email();

    switch($_GET["op"]){
        case "guardar":
            // Insertar una nueva cotizacion
            $datos=$cotizacion->insert_cotizacion(
                $_POST["cli_id"],
                $_POST["con_id"], 
                $_POST["cli_ruc"], 
                $_POST["con_telf"], 
                $_POST["con_email"], 
                $_POST["cot_descrip"],
                $_POST["usu_id"]
            );

            if(empty($_POST["cot_id"])){
                // TODO: Verificar si la inserción devolvió resultados válidos
                if(is_array($datos)==true and count($datos) > 0){
                    foreach($datos as $row){
                        $output["cot_id"] = $row["cot_id"]; // TODO: Almacenar cot_id en el array de respuesta
                    }
                }

                // TODO: Enviar los datos como JSON
                echo json_encode($output);   
            }
               
        break;
        
        case "dguardar":
            // Validar que se reciban los datos
            // Insertar una nueva cotización
            $datos = $cotizacion->insert_dcotizacion(
                $_POST["cot_id"],
                $_POST["cat_id"], 
                $_POST["prod_id"], 
                $_POST["cotd_precio"], 
                $_POST["cotd_cant"],
                $_POST["cotd_tipo"],
            );
            if(is_array($datos)==true and count($datos) > 0){
                foreach($datos as $row){
                    $output["cot_id"] = $row["cotd_id"]; // TODO: Almacenar cot_id en el array de respuesta
                }
            }

            // TODO: Enviar los datos como JSON
            echo json_encode($output);  
        break;
  
        case "listard":
            // Validar que se reciban los datos
           if (isset($_POST["cot_id"]) && isset($_POST["cotd_tipo"])) {
           
               $datos = $cotizacion->get_dcotizacion($_POST["cot_id"],$_POST["cotd_tipo"]);
               $data = Array();
               foreach($datos as $row){
                   $sub_array = array();
                   $sub_array[] = htmlspecialchars($row["cat_nom"]); // Evita XSS
                   $sub_array[] = htmlspecialchars($row["prod_nom"]); // Evita XSS
                   $sub_array[] = htmlspecialchars($row["cotd_precio"]); // Evita XSS
                   $sub_array[] = htmlspecialchars($row["cotd_cant"]); // Evita XSS
                   $sub_array[] = htmlspecialchars($row["cotd_profit"]); // Evita XSS
                   $sub_array[] = htmlspecialchars($row["cotd_total"]); // Evita XSS
                   $sub_array[] = '<button type="button" onClick="editard('.$row["cotd_id"].')" id="'.$row["cotd_id"].'" class="btn bg-gradient-success w-100 pd-0 mi-btn"><i class="material-icons opacity-10">edit</i></button>';
                   $sub_array[] = '<button type="button" onClick="eliminard('.$row["cotd_id"].')" id="'.$row["cotd_id"].'" class="btn bg-gradient-primary w-100 pd-0 mi-btn"><i class="material-icons opacity-10">delete</i></button>';
                   $data[] = $sub_array;
               }
    
               $results = array(
                   "sEcho" => 1,
                   "iTotalRecords" => count($data),
                   "iTotalDisplayRecords" => count($data),
                   "aaData" => $data
               );
               echo json_encode($results);
           }
        break;
        
        case "listarv":
            $datos = $cotizacion->get_dcotizacion($_POST["cot_id"], $_POST["cotd_tipo"]);
            foreach($datos as $row){
                ?>
                    <tr>
                        <td>
                            <span class="text-inverse"><?php echo $row["prod_nom"] ?></span><br>
                            <small><?php echo $row["prod_descrip"] ?></small>
                        </td>
                        <td class="text-center"><?php echo $row["cotd_cant"] ?></td>
                        <!-- <td class="text-center"><?php echo $row["cotd_precio"] ?></td> -->
                        <td class="text-center"><?php echo $row["cotd_subtotal"] ?></td>
                    </tr>
                <?php
            }

        break;

        case "listara_vacio":
            $datos = $cotizacion->get_dcotizacion($_POST["cot_id"],$_POST["cotd_tipo"]);
            if(is_array($datos)==true and count($datos) > 0){
                echo json_encode(1);
            }else{
                echo json_encode(0);
            }
        break;

        case "deliminar":
            // Verificamos si se recibió cotd_id
            if (isset($_POST["cotd_id"]) && isset($_POST["cot_id"])) {
                $cotd_id = $_POST["cotd_id"]; // Guardamos el ID recibido
                $cot_id = $_POST["cot_id"]; // Guardamos el cot_id recibido
                // Llamamos al método del modelo para eliminar el detalle de cotización
                $resultado = $cotizacion->delete_dcotizacion($cotd_id, $cot_id);
                
                // Verificamos si la eliminación fue exitosa
                if ($resultado) {
                    echo json_encode(array("status" => "success", "message" => "Registro eliminado"));
                } else {
                    echo json_encode(array("status" => "error", "message" => "Error al eliminar el registro"));
                }
            } else {
                // Aquí puedes registrar el error en un log para revisar después
                error_log("ID no proporcionado en la solicitud de eliminación. Datos recibidos: " . json_encode($_POST));
                
                // Respuesta si no se recibe el ID correcto
                echo json_encode(array("status" => "error", "message" => "ID no proporcionado"));
            }
        break;

        case "dmostrar":
            // Validar que se reciban los datos
            // Insertar una nueva cotización
            $datos = $cotizacion->get_dcotizacion_x_cotd_id($_POST["cotd_id"]);
            if(is_array($datos)==true and count($datos) > 0){
                foreach($datos as $row){
                    $output["cotd_id"] = $row["cotd_id"];
                    $output["cot_id"] = $row["cot_id"]; // TODO: Almacenar cot_id en el array de respuesta
                    $output["cat_nom"] = $row["cat_nom"];
                    $output["prod_nom"] = $row["prod_nom"];
                    $output["cotd_precio"] = $row["cotd_precio"];
                    $output["cotd_cant"] = $row["cotd_cant"];
                    $output["cotd_profit"] = $row["cotd_profit"];
                    $output["cotd_total"] = $row["cotd_total"];
                }
            }
            echo json_encode($output);
        break;

        case "dactualizar":
            // Validar que se reciban los datos
            // Insertar una nueva cotización
            $datos = $cotizacion->update_dcotizacion(
                $_POST["cotd_id"], 
                $_POST["cotd_precio"],
                $_POST["cotd_cant"], 
                $_POST["cotd_profit"],
                $_POST["cot_id"]);
            if(is_array($datos)==true and count($datos) > 0){
                foreach($datos as $row){
                    $output["cotd_id"] = $row["cotd_id"];
                }
            }
            echo json_encode($output);
        break;

        case "mostrar":
            // Validar que se reciban los datos
            // Insertar una nueva cotización
            $datos = $cotizacion->get_cotizacion($_POST["cot_id"]);
            if(empty($datos)){
                echo json_encode(["error" => "not_found"]);
            } else {
                if(is_array($datos)==true and count($datos) > 0){
                    foreach($datos as $row){
                        $output["cot_id"] = $row["cot_id"];
                        $output["cli_id"] = $row["cli_id"];
                        $output["cli_nom"] = $row["cli_nom"];
                        $output["cli_ruc"] = $row["cli_ruc"];
                        $output["cli_telf"] = $row["cli_telf"];
                        $output["cli_email"] = $row["cli_email"];
    
                        $output["con_id"] = $row["con_id"];
                        $output["con_nom"] = $row["con_nom"];
                        $output["con_telf"] = $row["con_telf"];
                        $output["con_email"] = $row["con_email"];
                        $output["cot_descrip"] = $row["cot_descrip"];
    
                        $output["emp_telf"] = $row["emp_telf"];
                        $output["emp_id"] = $row["emp_id"];
                        $output["emp_nom"] = $row["emp_nom"];
                        $output["emp_porcen"] = $row["emp_porcen"];
                        $output["emp_ruc"] = $row["emp_ruc"];
                        $output["emp_email"] = $row["emp_email"];
                        $output["emp_direc"] = $row["emp_direc"];
                        $output["emp_web"] = $row["emp_web"];
    
                        $output["cot_subtotal"] = $row["cot_subtotal"]; // TODO: Almacenar cot_id en el array de respuesta
                        $output["cot_profit"] = $row["cot_profit"];
                        $output["cot_total"] = $row["cot_total"];
    
                        $output["fech_crea_format"] = $row["fech_crea_format"];
                        $output["mes_en_texto"] = $row["mes_en_texto"];
                        $output["fech_respuesta"] = $row["fech_respuesta"];
                        $output["fech_respuesta_format"] = $row["fech_respuesta_format"];
    
                        $output["usu_id"] = $row["usu_id"];
                        $output["usu_nom"] = $row["usu_nom"];
                        $output["usu_correo"] = $row["usu_correo"];
    
                        $output["cot_contrato"] = $row["cot_contrato"];
                        $output["cot_adicional"] = $row["cot_adicional"];
                        $output["cot_saludo"] = $row["cot_saludo"];

                        $output["cot_tipo"] = $row["cot_tipo"];
    
                    }
                }
                echo json_encode($output);
            }
            
        break;

        case "actualizar":
            // Validar que se reciban los datos
            // Insertar una nueva cotización
            $datos = $cotizacion->update_cotizacion(
                $_POST["cot_id"], 
                $_POST["cot_saludo"],
                $_POST["cot_adicional"], 
                $_POST["cot_contrato"]); // linea 226
            if(is_array($datos)==true and count($datos) > 0){
                foreach($datos as $row){
                    $output["cot_id"] = $row["cot_id"];
                }
            }
            echo json_encode($output);
        break;

        case "actualizarvisto":
            // Validar que se reciban los datos
            // Insertar una nueva 
            $datos2=$cotizacion->get_cotizacion($_POST["cot_id"]);
            if(is_array($datos2)==true and count($datos2) > 0){
                foreach($datos2 as $row2){
                    if($row2["fech_visto"]==null){
                        $datos = $cotizacion->update_cotizacion_visto($_POST["cot_id"]);
                        $email->visto_cotizacion($_POST["cot_id"]);
                        if(is_array($datos)==true and count($datos) > 0){
                            foreach($datos as $row){
                                $output["cot_id"] = $row["cot_id"];
                            }
                        }
                        echo json_encode($output);
                    }
                }
            }
        break;

        case "actualizarrespuesta":
            // Validar que se reciban los datos
            // Insertar una nueva 
            $datos = $cotizacion->update_cotizacion_estado($_POST["cot_id"], $_POST["cot_tipo"]);
            $email->respuesta_cotizacion($_POST["cot_id"], $_POST["cot_tipo"]);
            if(is_array($datos)==true and count($datos) > 0){
                foreach($datos as $row){
                    $output["cot_id"] = $row["cot_id"];
                }
            }
            echo json_encode($output);

        break;

        case "ocultarrespuesta":
            $datos = $cotizacion->get_cotizacion($_POST["cot_id"]);
            if (is_array($datos) == true and count($datos) > 0) {
                foreach ($datos as $row) {
                    // Si la respuesta es null (la cotización no ha sido respondida)
                    if ($row["fech_respuesta"] == null) {
                        // Actualizar el estado como visto
                        $datos = $cotizacion->update_cotizacion_visto($_POST["cot_id"]);
                        // Llamar a la función para marcarla como "vista" en el email
                        $email->visto_cotizacion($_POST["cot_id"]);
                        echo json_encode(0); // Mostrar el div porque aún no ha sido respondida
                    } else {
                        echo json_encode(1); // Ocultar el div porque ya ha sido respondida
                    }
                }
            } else {
                echo json_encode(1); // En caso de que no haya datos, ocultar el div
            }
            break;
        
        // case "ocultarrespuesta":
        //     // Validar que se reciban los datos
        //     // Insertar una nueva 
        //     $datos=$cotizacion->get_cotizacion($_POST["cot_id"]);
        //     if(is_array($datos)==true and count($datos) > 0){
        //         foreach($datos as $row){
        //             if($row["fech_respuesta"]==null){
        //                 $datos = $cotizacion->update_cotizacion_visto($_POST["cot_id"]);
        //                 $email->visto_cotizacion($_POST["cot_id"]);
        //                 if(is_array($datos)==true and count($datos) > 0){
        //                     echo json_encode(0);
        //                 } else {
        //                     echo json_encode($output);
        //                 }
                       
        //             }
        //         }
        //     }
        // break;

    }
?>