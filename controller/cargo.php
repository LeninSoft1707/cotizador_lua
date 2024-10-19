<?php 
// En tu archivo PHP, asegurarte de que se obtienen los cargos correctamente
require_once("../config/conexion.php");
require_once("../models/Cargo.php");

$cargo = new Cargo();

switch ($_GET["op"]) {
    case "combo":
        try {
            $datos = $cargo->get_cargo(); // Asumiendo que este método obtiene los cargos
            if (is_array($datos) && count($datos) > 0) {
                $html = "<option selected>Seleccionar</option>";
                foreach($datos as $row) {
                    $html .= "<option value='".htmlspecialchars($row["car_id"])."'>".htmlspecialchars($row["car_nom"])."</option>";
                }
                echo $html;
            } else {
                echo "<option selected>No hay cargos disponibles</option>";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        break;

    default:
        echo "Operación no válida";
        break;
}
?>