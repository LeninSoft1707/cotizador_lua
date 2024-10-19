<?php
    // TODO: Incluye el archivo de configuración y conexión a la base de datos.
    require_once("../config/conexion.php");
    
    // TODO: Incluye el archivo que define la clase `Contacto`.
    require_once("../models/Producto.php");

    // TODO: Crea una instancia de la clase `Contacto`.
    $producto = new Producto();

    // TODO: Usa una estructura `switch` para manejar diferentes operaciones basadas en el parámetro `op` de la solicitud GET.
    switch($_GET["op"]){
        // TODO: Caso para guardar o editar un contacto.

        case "guardaryeditar":
            if (!isset($_POST["prod_id"]) || empty($_POST["prod_id"])) {
                // Verificar si ya existe un producto con el mismo nombre
                $datos = $producto->get_producto_x_nombre($_POST["prod_nom"]);
                if (is_array($datos) == true and count($datos)> 0) {
                    // Respuesta para producto duplicado
                    echo json_encode(array("status" => "error", "message" => "La categoría ya existe"));
                } else {
                    try {
                        // Insertar un nuevo producto
                        $producto->insert_producto($_POST["cat_id"], $_POST["prod_nom"], $_POST["prod_descrip"], $_POST["prod_precio"]);
                        echo json_encode(array("status" => "ok", "message" => "Producto registrado correctamente"));
                    } catch (Exception $e) {
                        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
                    }
                }
            } else {
                // Verificar si el correo ya existe en otro usuario antes de actualizar
                $datos = $producto->get_producto_x_nombre($_POST["prod_nom"]);
                if (is_array($datos) == true and count($datos) > 0 && $datos[0]['prod_id'] != $_POST["prod_id"]) {
                    // Si el correo existe en otro usuario (diferente al que se está editando)
                    echo json_encode(array("status" => "error", "message" => "El producto ya existe en otro usuario"));
                } else {
                try {
                    // Actualizar producto existente
                    $producto->update_producto($_POST["prod_id"], $_POST["cat_id"], $_POST["prod_nom"], $_POST["prod_descrip"], $_POST["prod_precio"]);
                    echo json_encode(array("status" => "ok", "message" => "Producto registrado correctamente"));
                } catch (Exception $e) {
                    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
                }
            }
        }
        break;
        
        // TODO: Caso para listar todos los contactos.
        case "listar":
            $datos = $producto->get_producto();
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = htmlspecialchars($row["cat_nom"]); // Evita XSS
                $sub_array[] = htmlspecialchars($row["prod_nom"]); // Evita XSS
                $sub_array[] = htmlspecialchars($row["prod_descrip"]); // Evita XSS
                $sub_array[] = htmlspecialchars($row["prod_precio"]); // Evita XSS
                $sub_array[] = '<button type="button" onClick="editar('.$row["prod_id"].')" id="'.$row["prod_id"].'" class="btn bg-gradient-success w-100 pd-0 mi-btn">Editar</button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["prod_id"].')" id="'.$row["prod_id"].'" class="btn bg-gradient-primary w-100 pd-0 mi-btn">Eliminar</button>';
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
            if (isset($_POST["prod_id"])) {
                $datos = $producto->get_producto_x_id($_POST["prod_id"]);
                if (is_array($datos) && count($datos) > 0){
                    foreach($datos as $row){
                        $output["prod_id"] = $row["prod_id"];
                        $output["cat_id"] = $row["cat_id"];
                        $output["prod_nom"] = $row["prod_nom"];
                        $output["prod_descrip"] = $row["prod_descrip"];
                        $output["prod_precio"] = $row["prod_precio"];
                        
                    }
                    echo json_encode($output);
                } else {
                    echo json_encode(["status" => "error", "message" => "Producto no encontrado"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "ID de producto no proporcionado"]);
            }
            break;

        // TODO: Caso para eliminar un contacto por su ID.
        case "eliminar":
            // TODO: Llama al método `delete_contacto` para desactivar (eliminar) un contacto específico.
            $producto->delete_producto($_POST["prod_id"]);
            break;
    
        // TODO: Caso para obtener el combo de contactos.
        case "combo":
            $datos = $producto->get_producto();
            if (is_array($datos) && count($datos) > 0){
                $html = "<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html .= "<option value='".htmlspecialchars($row["cat_id"])."'>".htmlspecialchars($row["cat_nom"])."</option>";
                }
                echo $html;
            } else {
                echo "<option selected>No hay categorias disponibles</option>";
            }
            break;

        case "combo_x_categoria":
            $datos = $producto->get_producto_x_categoria($_POST["cat_id"]);
            if (is_array($datos) && count($datos) > 0){
                $html = "<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html .= "<option value='".htmlspecialchars($row["prod_id"])."'>".htmlspecialchars($row["prod_nom"])."</option>";
                }
                echo $html;
            } else {
                echo "<option selected>No hay categorias disponibles</option>";
            }
        break;
    }
?>
