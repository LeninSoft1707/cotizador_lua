<?php 
    // TODO: Define una clase `Cliente` que hereda de la clase `Conectar`.
    class Cliente extends Conectar {

        // TODO: Método para obtener todos los clientes activos (con estado `est=1`).
        public function get_cliente() {
            // TODO: Establece la conexión a la base de datos llamando al método `Conexion` de la clase padre (`Conectar`).
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar todos los clientes con estado activo.
            $sql = "SELECT * FROM tm_cliente WHERE est=1;";
            
            // TODO: Prepara la consulta SQL para evitar inyecciones SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Ejecuta la consulta preparada.
            $sql->execute();
            
            // TODO: Retorna todos los resultados obtenidos de la consulta en un array.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para insertar un nuevo cliente en la base de datos.
        public function insert_cliente($cli_nom, $cli_ruc, $cli_telf, $cli_email) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define la consulta SQL para insertar un nuevo cliente. `cli_id` es auto-incrementado, por lo que se pasa como `NULL`.
            $sql = "INSERT INTO tm_cliente (cli_nom, cli_ruc, cli_telf, cli_email, est) VALUES (?, ?, ?, ?, '1');";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza los valores del cliente a los parámetros de la consulta SQL.
            $sql->bindValue(1, $cli_nom);
            $sql->bindValue(2, $cli_ruc);
            $sql->bindValue(3, $cli_telf);
            $sql->bindValue(4, $cli_email);
            
            // TODO: Ejecuta la consulta SQL preparada para insertar el nuevo cliente.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para actualizar un cliente existente.
        public function update_cliente($cli_id, $cli_nom, $cli_ruc, $cli_telf, $cli_email) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para actualizar los datos de un cliente específico basado en su `cli_id`.
            $sql = "UPDATE tm_cliente set
                cli_nom = ?, 
                cli_ruc = ?, 
                cli_telf = ?, 
                cli_email = ?
                WHERE
                cli_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza los valores actualizados del cliente a los parámetros de la consulta.
            $sql->bindValue(1, $cli_nom);
            $sql->bindValue(2, $cli_ruc);
            $sql->bindValue(3, $cli_telf);
            $sql->bindValue(4, $cli_email);
            $sql->bindValue(5, $cli_id);
            
            // TODO: Ejecuta la consulta SQL para actualizar el cliente.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para desactivar un cliente (cambia el estado `est` a 0).
        public function delete_cliente($cli_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para cambiar el estado (`est`) de un cliente a 0, lo que efectivamente lo desactiva.
            $sql = "UPDATE tm_cliente set
                est = 0
                WHERE
                cli_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del cliente al parámetro de la consulta.
            $sql->bindValue(1, $cli_id);
            
            // TODO: Ejecuta la consulta SQL para desactivar el cliente.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para obtener los detalles de un cliente por su ID.
        public function get_cliente_x_id($cli_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar un cliente específico por su `cli_id`.
            $sql = "SELECT * FROM tm_cliente WHERE cli_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del cliente al parámetro de la consulta.
            $sql->bindValue(1, $cli_id);
            
            // TODO: Ejecuta la consulta SQL para obtener el cliente específico.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }

        public function get_cliente_x_nombre($cli_ruc) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar una categoría específica por su `cat_id`.
            $sql = "SELECT * FROM tm_cliente
            WHERE cli_ruc = ?
            AND est=1";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID de la categoría al primer parámetro de la consulta.
            $sql->bindValue(1, $cli_ruc);
            
            // TODO: Ejecuta la consulta SQL para obtener la categoría específica.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }
    }

?>
