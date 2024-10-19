<?php 
    require_once("../config/conexion.php");
    require_once("../models/Empresa.php");

    $empresa = new Empresa();

    switch($_GET["op"]){
        case "guardaryeditar":
            if (!isset($_POST["emp_id"]) || empty($_POST["emp_id"])) {
                // Verificar si ya existe un producto con el mismo nombre
                $datos = $empresa->get_empresa_x_nombre($_POST["emp_nom"]);
                if (is_array($datos) == true and count($datos)> 0) {
                    // Respuesta para producto duplicado
                    echo json_encode(array("status" => "error", "message" => "La empresa ya existe"));
                } else {
                    try {
                        // Insertar un nuevo producto
                        $empresa->insert_empresa($_POST["emp_nom"], $_POST["emp_porcen"]);
                        echo json_encode(array("status" => "ok", "message" => "Empresa registrada correctamente"));
                    } catch (Exception $e) {
                        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
                    }
                }
            } else {
                // Verificar si el correo ya existe en otro usuario antes de actualizar
                $datos = $empresa->get_empresa_x_nombre($_POST["emp_nom"]);
                if (is_array($datos) == true and count($datos) > 0 && $datos[0]['emp_id'] != $_POST["emp_id"]) {
                    // Si el correo existe en otro usuario (diferente al que se está editando)
                    echo json_encode(array("status" => "error", "message" => "La empresa ya existe en otro usuario"));
                } else {
                    try {
                        // Actualizar producto existente
                        $empresa->update_empresa($_POST["emp_id"],$_POST["emp_nom"], $_POST["emp_porcen"]);
                        echo json_encode(array("status" => "ok", "message" => "Correo actualizado correctamente"));
                } catch (Exception $e) {
                    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
                }
            }
            }
        break;

        case "listar":
            $datos = $empresa->get_empresa();
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = htmlspecialchars($row["emp_nom"]); // Evita XSS
                $sub_array[] = htmlspecialchars($row["emp_porcen"]); // Evita XSS
                $sub_array[] = '<button type="button" onClick="editar('.$row["emp_id"].')" id="'.$row["emp_id"].'" class="btn bg-gradient-success w-100 pd-0 mi-btn">Editar</button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["emp_id"].')" id="'.$row["emp_id"].'" class="btn bg-gradient-primary w-100 pd-0 mi-btn">Eliminar</button>';
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

        case "mostrar":
            if (isset($_POST["emp_id"])) {
                $datos = $empresa->get_empresa_x_id($_POST["emp_id"]);
                if (is_array($datos) && count($datos) > 0){
                    foreach($datos as $row){
                        $output["emp_id"] = $row["emp_id"];
                        $output["emp_nom"] = $row["emp_nom"];
                        $output["emp_porcen"] = $row["emp_porcen"];
                    }
                    echo json_encode($output);
                } else {
                    echo json_encode(["status" => "error", "message" => "Empresa no encontrada"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "ID de empresa no proporcionado"]);
            }
            break;

        case "eliminar":
            if (isset($_POST["emp_id"])) {
                try {
                    $empresa->delete_empresa($_POST["emp_id"]);
                    echo json_encode(["status" => "success", "message" => "Empresa eliminada exitosamente"]);
                } catch (Exception $e) {
                    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "ID de empresa no proporcionado"]);
            }
            break;

        case "combo":
            $datos = $empresa->get_empresa();
            if (is_array($datos) && count($datos) > 0){
                $html = "<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html .= "<option value='".htmlspecialchars($row["emp_id"])."'>".htmlspecialchars($row["emp_nom"])."</option>";
                }
                echo $html;
            } else {
                echo "<option selected>No hay empresas disponibles</option>";
            }
            break;
    }
?>

