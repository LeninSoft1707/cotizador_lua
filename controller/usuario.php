<?php 
    // TODO: Incluye el archivo de configuración y conexión a la base de datos.
    require_once("../config/conexion.php");
    
    // TODO: Incluye el archivo que define la clase Usuario.
    require_once("../models/Usuario.php");

    // TODO: Crea una instancia de la clase Usuario.
    $usuario = new Usuario();

    // TODO: Usa una estructura switch para manejar diferentes operaciones basadas en el parámetro op de la solicitud GET.
    switch($_GET["op"]){
        // TODO: Caso para guardar o editar un usuario.
        case "guardaryeditar":
            if (!isset($_POST["usu_id"]) || empty($_POST["usu_id"])) {
                // Verificar si ya existe un producto con el mismo nombre
                $datos = $usuario->get_usuario_x_nombre($_POST["usu_correo"]);
                if (is_array($datos) == true and count($datos)> 0) {
                    // Respuesta para producto duplicado
                    echo json_encode(array("status" => "error", "message" => "El correo ya existe"));
                } else {
                    try {
                        // Insertar un nuevo producto
                        $usuario->insert_usuario($_POST["usu_correo"], $_POST["usu_nom"], $_POST["usu_pass"]);
                        echo json_encode(array("status" => "ok", "message" => "Correo registrado correctamente"));
                    } catch (Exception $e) {
                        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
                    }
                }
            } else {
                // Verificar si el correo ya existe en otro usuario antes de actualizar
                $datos = $usuario->get_usuario_x_nombre($_POST["usu_correo"]);
                if (is_array($datos) == true and count($datos) > 0 && $datos[0]['usu_id'] != $_POST["usu_id"]) {
                    // Si el correo existe en otro usuario (diferente al que se está editando)
                    echo json_encode(array("status" => "error", "message" => "El correo ya existe en otro usuario"));
                } else {
                    try {
                        // Actualizar producto existente
                        $usuario->update_usuario($_POST["usu_id"], $_POST["usu_correo"], $_POST["usu_nom"], $_POST["usu_pass"]);
                        echo json_encode(array("status" => "ok", "message" => "Correo actualizado correctamente"));
                } catch (Exception $e) {
                    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
                }
            }
            }
        break;
        
        // TODO: Caso para listar todos los usuarios.
        case "listar":
            // TODO: Llama al método get_usuario para obtener todos los usuarios.
            $datos = $usuario->get_usuario();
            // TODO: Inicializa un array para almacenar los datos de los usuarios.
            $data = Array();
            // TODO: Itera sobre cada usuario obtenido.
            foreach($datos as $row){
                // TODO: Inicializa un array para almacenar los datos de un usuario específico.
                $sub_array = array();
                // TODO: Agrega el correo del usuario al array.
                $sub_array[] = $row["usu_correo"];
                // TODO: Agrega el nombre del usuario al array.
                $sub_array[] = $row["usu_nom"];
                // TODO: Agrega botones para editar y eliminar el usuario, con el usu_id como parámetro para las funciones JavaScript correspondientes.
                // TODO: Agrega botones para editar y eliminar la categoría, con el `cat_id` como parámetro para las funciones JavaScript correspondientes.
                $sub_array[] = '<button type="button" onClick="editar('.$row["usu_id"].')" id="'.$row["usu_id"].'" class="btn bg-gradient-success w-100 pd-0 mi-btn">Editar</button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["usu_id"].')" id="'.$row["usu_id"].'" class="btn bg-gradient-primary w-100 pd-0 mi-btn">Eliminar</button>';
                // TODO: Agrega el array de datos del usuario al array principal.
                $data[] = $sub_array;
            }

            // TODO: Prepara el array de resultados para el formato JSON, incluyendo la información de paginación y los datos de los usuarios.
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            // TODO: Codifica el array de resultados en formato JSON y lo envía al cliente.
            echo json_encode($results);
            break;
        
        // TODO: Caso para mostrar los detalles de un usuario por su ID.
        case "mostrar":
            if (isset($_POST["usu_id"])) {
                $datos = $usuario->get_usuario_x_id($_POST["usu_id"]);
                if (is_array($datos) && count($datos) > 0){
                    foreach($datos as $row){
                        $output["usu_id"] = $row["usu_id"];
                        $output["usu_correo"] = $row["usu_correo"];
                        $output["usu_nom"] = $row["usu_nom"];
                        $output["usu_pass"] = $row["usu_pass"];
                    }
                    echo json_encode($output);
                } else {
                    echo json_encode(["status" => "error", "message" => "Usuario no encontrada"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "ID de usuario no proporcionado"]);
            }
            break;

        // TODO: Caso para eliminar un usuario por su ID.
        case "eliminar":
            // TODO: Llama al método delete_usuario para desactivar (eliminar) un usuario específico.
            $usuario->delete_usuario($_POST["usu_id"]);
            break;
    
        // TODO: Caso para obtener el combo de usuarios.
        case "combo":
            $datos = $usuario->get_usuario();
            if (is_array($datos) && count($datos) > 0){
                $html = "<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html .= "<option value='".htmlspecialchars($row["usu_id"])."'>".htmlspecialchars($row["usu_nom"])."</option>";
                }
                echo $html;
            } else {
                echo "<option selected>No hay usuarios disponibles</option>";
            }
            break;
    }
?>
