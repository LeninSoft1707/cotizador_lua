<?php
    // TODO: Incluye el archivo de configuración y conexión a la base de datos.
    require_once("../config/conexion.php");
    
    // TODO: Incluye el archivo que define la clase `Categoria`.
    require_once("../models/Categoria.php");

    // TODO: Crea una instancia de la clase `Categoria`.
    $categoria = new Categoria();

    // TODO: Usa una estructura `switch` para manejar diferentes operaciones basadas en el parámetro `op` de la solicitud GET.
    switch($_GET["op"]){
        // TODO: Caso para guardar o editar una categoría.
        case "guardaryeditar":
            // TODO: Verifica si el campo `cat_id` está vacío para determinar si se debe insertar o actualizar una categoría.
            if (empty($_POST["cat_id"])){
                $datos=$categoria->get_categoria_x_nombre($_POST["cat_nom"]);
                if(is_array($datos) == true and count($datos) > 0){
                    echo json_encode(array("status" => "error", "message" => "La categoría ya existe"));
                }else{
                    // TODO: Si `cat_id` está vacío, llama al método `insert_categoria` para insertar una nueva categoría con nombre y descripción.
                    $categoria->insert_categoria($_POST["cat_nom"], $_POST["cat_descrip"]);
                    echo json_encode(array("status" => "ok", "message" => "Categoría registrada correctamente"));
                }
            } else {
                // Verificar si el correo ya existe en otro usuario antes de actualizar
                $datos = $categoria->get_categoria_x_nombre($_POST["cat_nom"]);
                if (is_array($datos) == true and count($datos) > 0 && $datos[0]['cat_id'] != $_POST["cat_id"]) {
                    // Si el correo existe en otro usuario (diferente al que se está editando)
                    echo json_encode(array("status" => "error", "message" => "El correo ya existe en otro usuario"));
                } else {
                    // TODO: Si `cat_id` no está vacío, llama al método `update_categoria` para actualizar una categoría existente.
                    $categoria->update_categoria($_POST["cat_id"], $_POST["cat_nom"], $_POST["cat_descrip"]);
                    echo json_encode(array("status" => "ok", "message" => "Categoría actualizada correctamente"));
                }

            }
            break;
        
        // TODO: Caso para listar todas las categorías.
        case "listar":
            // TODO: Llama al método `get_categoria` para obtener todas las categorías.
            $datos = $categoria->get_categoria();
            // TODO: Inicializa un array para almacenar los datos de las categorías.
            $data = Array();
            // TODO: Itera sobre cada categoría obtenida.
            foreach($datos as $row){
                // TODO: Inicializa un array para almacenar los datos de una categoría específica.
                $sub_array = array();
                // TODO: Agrega el nombre de la categoría al array.
                // $sub_array[] = $row["cat_id"];
                // TODO: Agrega el nombre de la categoría al array.
                $sub_array[] = $row["cat_nom"];
                // TODO: Agrega la descripción de la categoría al array.
                $sub_array[] = $row["cat_descrip"];
                // TODO: Agrega botones para editar y eliminar la categoría, con el `cat_id` como parámetro para las funciones JavaScript correspondientes.
                $sub_array[] = '<button type="button" onClick="editar('.$row["cat_id"].')" id="'.$row["cat_id"].'" class="btn bg-gradient-success w-100 pd-0 mi-btn" >Editar</button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["cat_id"].')" id="'.$row["cat_id"].'" class="btn bg-gradient-primary w-100 pd-0 mi-btn">Eliminar</button>';
                // TODO: Agrega el array de datos de la categoría al array principal.
                $data[] = $sub_array;
            }

            // TODO: Prepara el array de resultados para el formato JSON, incluyendo la información de paginación y los datos de las categorías.
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            // TODO: Codifica el array de resultados en formato JSON y lo envía al cliente.
            echo json_encode($results);
            break;
        
        // TODO: Caso para mostrar los detalles de una categoría por su ID.
        case "mostrar":
            // TODO: Llama al método `get_categoria_x_id` para obtener los detalles de una categoría específica.
            $datos = $categoria->get_categoria_x_id($_POST["cat_id"]);
            // TODO: Verifica si los datos obtenidos son un array y si contiene elementos.
            if (is_array($datos) == true and count($datos) > 0){
                // TODO: Inicializa un array para almacenar los detalles de la categoría.
                foreach($datos as $row){
                    $output["cat_id"] = $row["cat_id"];
                    $output["cat_nom"] = $row["cat_nom"];
                    $output["cat_descrip"] = $row["cat_descrip"];
                }
                // TODO: Codifica el array de detalles en formato JSON y lo envía al cliente.
                echo json_encode($output);
            }
            break;

        // TODO: Caso para eliminar una categoría por su ID.
        case "eliminar":
            // TODO: Llama al método `delete_categoria` para desactivar (eliminar) una categoría específica.
            $categoria->delete_categoria($_POST["cat_id"]);
            break;
    
        // TODO: Caso para obtener el combo de categorías.
        case "combo":
            // TODO: Llama al método `get_categoria` para obtener todas las categorías.
            $datos = $categoria->get_categoria();
            // TODO: Verifica si los datos obtenidos son un array y si contiene elementos.
            if (is_array($datos) == true and count($datos) > 0){
                // TODO: Inicializa una variable para almacenar el HTML del combo.
                $html = "";
                // TODO: Agrega una opción de selección por defecto al combo.
                $html .= "<option selected>Seleccionar</option>";
                // TODO: Itera sobre cada categoría obtenida.
                foreach($datos as $row){
                    // TODO: Agrega una opción al combo con el `cat_id` como valor y el nombre de la categoría como texto.
                    $html .= "<option value='".$row["cat_id"]."'>".$row["cat_nom"]."</option> ";
                }
                // TODO: Envía el HTML del combo al cliente.
                echo $html;
            }
            break;
    }
?>
