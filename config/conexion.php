<?php 

    // TODO: Inicia la sesión para almacenar y acceder a datos de sesión.
    session_start();

    // TODO: Clase que gestiona la conexión a la base de datos.
    class Conectar {
        
        // TODO: Variable que contendrá el manejador de la conexión a la base de datos (PDO).
        protected $dbh;

        // TODO: Método que establece la conexión con la base de datos MySQL utilizando PDO.
        protected function Conexion() {
            try {
                // TODO: Crea una nueva instancia de PDO para conectarse a la base de datos 'cotizador' en 'localhost' con el usuario 'root' y contraseña 'root'.
                $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=cotizador", "root", "root");
                
                // TODO: Retorna la conexión si es exitosa.
                return $conectar;
            } catch (Exception $e) {
                // TODO: Imprime un mensaje de error en caso de fallo en la conexión a la base de datos.
                print "!Error DB!:" . $e->getMessage() . "<br/>";
                
                // TODO: Detiene la ejecución del script si ocurre un error.
                die();
            }
        }

        // TODO: Método que establece el conjunto de caracteres de la base de datos a UTF-8 para evitar problemas con caracteres especiales.
        public function set_names() {
            return $this->dbh->query("SET NAMES 'utf8'");
        }
    
        // TODO: Método estático que devuelve la URL base del proyecto.
        public static function ruta() {
            return "http://localhost:90/Cotizador_lua/";
        }
    }

?>

