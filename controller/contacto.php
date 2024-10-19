<?php
    // TODO: Incluye el archivo de configuración y conexión a la base de datos.
    require_once("../config/conexion.php");
    
    // TODO: Incluye el archivo que define la clase `Contacto`.
    require_once("../models/Contacto.php");

    // TODO: Crea una instancia de la clase `Contacto`.
    $contacto = new Contacto();

    // TODO: Usa una estructura `switch` para manejar diferentes operaciones basadas en el parámetro `op` de la solicitud GET.
    switch($_GET["op"]){

        // TODO: Caso para guardar o editar un contacto.
        case "guardaryeditar":
            if (!isset($_POST["con_id"]) || empty($_POST["con_id"])){
                // Verificar si ya existe un producto con el mismo nombre
                $datos = $contacto->get_contacto_x_nombre($_POST["con_email"]);
                if (is_array($datos) == true and count($datos)> 0) {
                    // Respuesta para producto duplicado
                    echo json_encode(array("status" => "error", "message" => "La categoría ya existe"));
                } else {
                    try {
                        $contacto->insert_contacto($_POST["cli_id"], $_POST["car_id"], $_POST["con_nom"], $_POST["con_email"], $_POST["con_telf"]);
                        echo json_encode(["status" => "success", "message" => "Contacto insertado exitosamente"]);
                    } catch (Exception $e) {
                        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
                    }
                }
            } else {
                // Verificar si el correo ya existe en otro usuario antes de actualizar
                $datos = $contacto->get_contacto_x_nombre($_POST["con_email"]);
                if (is_array($datos) == true and count($datos) > 0 && $datos[0]['con_id'] != $_POST["con_id"]) {
                    // Si el correo existe en otro usuario (diferente al que se está editando)
                    echo json_encode(array("status" => "error", "message" => "El producto ya existe en otro usuario"));
                } else {
                try {
                    $contacto->update_contacto($_POST["con_id"], $_POST["cli_id"], $_POST["car_id"], $_POST["con_nom"], $_POST["con_email"], $_POST["con_telf"]);
                    echo json_encode(["status" => "success", "message" => "Contacto actualizado exitosamente"]);
                } catch (Exception $e) {
                    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
                }
            }
        }
        break;
        
        // TODO: Caso para listar todos los contactos.
        case "listar":
            $datos = $contacto->get_contacto();
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = htmlspecialchars($row["cli_nom"]); // Evita XSS
                $sub_array[] = htmlspecialchars($row["car_nom"]); // Evita XSS
                $sub_array[] = htmlspecialchars($row["con_nom"]); // Evita XSS
                $sub_array[] = htmlspecialchars($row["con_email"]); // Evita XSS
                $sub_array[] = htmlspecialchars($row["con_telf"]); // Evita XSS
                $sub_array[] = '<button type="button" onClick="editar('.$row["con_id"].')" id="'.$row["con_id"].'" class="btn bg-gradient-success w-100 pd-0 mi-btn">Editar</button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["con_id"].')" id="'.$row["con_id"].'" class="btn bg-gradient-primary w-100 pd-0 mi-btn">Eliminar</button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            echo json_encode($results);
            break;

        
        // TODO: Caso para mostrar los detalles de un contacto por su ID.
        case "mostrar":
            if (isset($_POST["con_id"])) {
                $datos = $contacto->get_contacto_x_id($_POST["con_id"]);
                if (is_array($datos) && count($datos) > 0){
                    foreach($datos as $row){
                        $output["con_id"] = $row["con_id"];
                        $output["cli_id"] = $row["cli_id"];
                        $output["car_id"] = $row["car_id"];
                        $output["con_nom"] = $row["con_nom"];
                        $output["con_email"] = $row["con_email"];
                        $output["con_telf"] = $row["con_telf"];
                        
                    }
                    echo json_encode($output);
                } else {
                    echo json_encode(["status" => "error", "message" => "Cliente no encontrado"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "ID de cliente no proporcionado"]);
            }
            break;

        // TODO: Caso para eliminar un contacto por su ID.
        case "eliminar":
            // TODO: Llama al método `delete_contacto` para desactivar (eliminar) un contacto específico.
            $contacto->delete_contacto($_POST["con_id"]);
            break;
    
        // TODO: Caso para obtener el combo de contactos.
        case "combo":
            $datos = $contacto->get_contacto();
            if (is_array($datos) && count($datos) > 0){
                $html = "<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html .= "<option value='".htmlspecialchars($row["car_id"])."'>".htmlspecialchars($row["car_nom"])."</option>";
                }
                echo $html;
            } else {
                echo "<option selected>No hay usuarios disponibles</option>";
            }
            break;
        case "combo_x_cliente":
            $datos = $contacto->get_contacto_x_ciente_id($_POST["cli_id"]);
            if (is_array($datos) && count($datos) > 0){
                $html = "<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html .= "<option value='".htmlspecialchars($row["con_id"])."'>".htmlspecialchars($row["con_nom"])."</option>";
                }
                echo $html;
            } else {
                echo "<option selected>No hay usuarios disponibles</option>";
            }
            break;            
            
    }
?>
