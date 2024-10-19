<?php 
// En tu archivo PHP, asegurarte de que se obtienen los cargos correctamente
require_once("../config/conexion.php");
require_once("../models/Email.php");

$email = new Email();

switch ($_GET["op"]) {
    case "envio":
        try {
            $datos = $email->envio_cotizacion($_POST["cot_id"]); // Asumiendo que este método obtiene los cargos
            echo json_encode($datos);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        break;

    default:
        echo "Operación no válida";
        break;
}

?>
