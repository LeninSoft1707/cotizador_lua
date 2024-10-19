<?php
    // TODO: Incluye el archivo de configuración y conexión a la base de datos.
    require_once("../config/conexion.php");
    
    // TODO: Incluye el archivo que define la clase `Cliente`.
    require_once("../models/Cliente.php");

    // TODO: Crea una instancia de la clase `Cliente`.
    $cliente = new Cliente();

    // TODO: Usa una estructura `switch` para manejar diferentes operaciones basadas en el parámetro `op` de la solicitud GET.
    switch($_GET["op"]){
        // TODO: Caso para guardar o editar un cliente.
        case "guardaryeditar":
            if (!isset($_POST["cli_id"]) || empty($_POST["cli_id"])) {
                // Verificar si ya existe un producto con el mismo nombre
                $datos = $cliente->get_cliente_x_nombre($_POST["cli_ruc"]);
                if (is_array($datos) == true and count($datos)> 0) {
                    // Respuesta para producto duplicado
                    echo json_encode(array("status" => "error", "message" => "El DNI O RUC ya existe"));
                } else {
                    try {
                        // Insertar un nuevo producto
                        $cliente->insert_cliente($_POST["cli_nom"], $_POST["cli_ruc"], $_POST["cli_telf"], $_POST["cli_email"]);
                        echo json_encode(array("status" => "ok", "message" => "Cliente registrado correctamente"));
                    } catch (Exception $e) {
                        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
                    }
                }
            } else {
                // Verificar si el correo ya existe en otro usuario antes de actualizar
                $datos = $cliente->get_cliente_x_nombre($_POST["cli_ruc"]);
                if (is_array($datos) == true and count($datos) > 0 && $datos[0]['cli_id'] != $_POST["cli_id"]) {
                    // Si el DNI O RUC existe en otro usuario (diferente al que se está editando)
                    echo json_encode(array("status" => "error", "message" => "El DNI O RUC ya existe en otro usuario"));
                } else {
                    try {
                        // Actualizar producto existente
                        $cliente->update_cliente($_POST["cli_id"], $_POST["cli_nom"], $_POST["cli_ruc"], $_POST["cli_telf"], $_POST["cli_email"]);
                        echo json_encode(array("status" => "ok", "message" => "Cliente actualizado correctamente"));
                } catch (Exception $e) {
                    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
                }
            }
            }
        break;
        
        // TODO: Caso para listar todos los clientes.
        case "listar":
            // TODO: Llama al método `get_cliente` para obtener todos los clientes.
            $datos = $cliente->get_cliente();
            // TODO: Inicializa un array para almacenar los datos de los clientes.
            $data = Array();
            // TODO: Itera sobre cada cliente obtenido.
            foreach($datos as $row){
                // TODO: Inicializa un array para almacenar los datos de un cliente específico.
                $sub_array = array();
                // TODO: Agrega el nombre del cliente al array.
                $sub_array[] = $row["cli_nom"];
                // TODO: Agrega el RUC del cliente al array.
                $sub_array[] = $row["cli_ruc"];
                // TODO: Agrega el teléfono del cliente al array.
                $sub_array[] = $row["cli_telf"];
                // TODO: Agrega el correo electrónico del cliente al array.
                $sub_array[] = $row["cli_email"];
                // TODO: Agrega botones para editar y eliminar el cliente, con el `cli_id` como parámetro para las funciones JavaScript correspondientes.
                $sub_array[] = '<button type="button" onClick="editar('.$row["cli_id"].')" id="'.$row["cli_id"].'" class="btn bg-gradient-success w-100 pd-0 mi-btn">Editar</button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["cli_id"].')" id="'.$row["cli_id"].'" class="btn bg-gradient-primary w-100 pd-0 mi-btn">Eliminar</button>';
                // TODO: Agrega el array de datos del cliente al array principal.
                $data[] = $sub_array;
            }

            // TODO: Prepara el array de resultados para el formato JSON, incluyendo la información de paginación y los datos de los clientes.
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            // TODO: Codifica el array de resultados en formato JSON y lo envía al cliente.
            echo json_encode($results);
            break;
        
        // TODO: Caso para mostrar los detalles de un cliente por su ID.
        case "mostrar":
            if (isset($_POST["cli_id"])) {
                $datos = $cliente->get_cliente_x_id($_POST["cli_id"]);
                if (is_array($datos) && count($datos) > 0){
                    foreach($datos as $row){
                        $output["cli_id"] = $row["cli_id"];
                        $output["cli_nom"] = $row["cli_nom"];
                        $output["cli_ruc"] = $row["cli_ruc"];
                        $output["cli_telf"] = $row["cli_telf"];
                        $output["cli_email"] = $row["cli_email"];
                    }
                    echo json_encode($output);
                } else {
                    echo json_encode(["status" => "error", "message" => "Cliente no encontrado"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "ID de cliente no proporcionado"]);
            }
            break;

        // TODO: Caso para eliminar un cliente por su ID.
        case "eliminar":
            // TODO: Llama al método `delete_cliente` para desactivar (eliminar) un cliente específico.
            $cliente->delete_cliente($_POST["cli_id"]);
            break;
    
        // TODO: Caso para obtener el combo de clientes.
        case "combo":
            $datos = $cliente->get_cliente();
            if (is_array($datos) && count($datos) > 0){
                $html = "<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html .= "<option value='".htmlspecialchars($row["cli_id"])."'>".htmlspecialchars($row["cli_nom"])."</option>";
                }
                echo $html;
            } else {
                echo "<option selected>No hay clientes disponibles</option>";
            }
            break;
    }
?>
