<?php 
    // TODO: Define una clase `Empresa` que hereda de la clase `Conectar`.
    class Cargo extends Conectar {

        // TODO: Método para obtener todas las empresas activas (con estado `est=1`).
        public function get_cargo() {
            // TODO: Establece la conexión a la base de datos llamando al método `Conexion` de la clase padre (`Conectar`).
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar todas las cargos con estado activo.
            $sql = "SELECT * FROM tm_cargo WHERE est=1;";
            
            // TODO: Prepara la consulta SQL para evitar inyecciones SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Ejecuta la consulta preparada.
            $sql->execute();
            
            // TODO: Retorna todos los resultados obtenidos de la consulta en un array.
            return $resultado = $sql->fetchAll();
        }

    }

?>