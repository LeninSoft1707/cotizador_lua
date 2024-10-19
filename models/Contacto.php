<?php 
    // TODO: Define una clase `Contacto` que hereda de la clase `Conectar`.
    class Contacto extends Conectar {

        // TODO: Método para obtener todos los contactos activos (con estado `est=1`).
        public function get_contacto() {
            // TODO: Establece la conexión a la base de datos llamando al método `Conexion` de la clase padre (`Conectar`).
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar todos los contactos con estado activo.
            $sql = "SELECT
            tm_contacto.con_id,
            tm_contacto.cli_id,
            tm_contacto.car_id,
            tm_contacto.con_nom,
            tm_contacto.con_email,
            tm_contacto.con_telf,
            tm_cliente.cli_id,
            tm_cliente.cli_nom,
            tm_cargo.car_id,
            tm_cargo.car_nom
            FROM tm_contacto
            INNER JOIN tm_cliente ON tm_contacto.cli_id = tm_cliente.cli_id
            INNER JOIN tm_cargo ON tm_contacto.car_id = tm_cargo.car_id
            WHERE
            tm_contacto.est=1;";
            
            // TODO: Prepara la consulta SQL para evitar inyecciones SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Ejecuta la consulta preparada.
            $sql->execute();
            
            // TODO: Retorna todos los resultados obtenidos de la consulta en un array.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para insertar un nuevo contacto en la base de datos.
        public function insert_contacto($cli_id, $car_id, $con_nom, $con_email, $con_telf) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define la consulta SQL para insertar un nuevo contacto. `con_id` es auto-incrementado, por lo que se pasa como `NULL`.
            $sql = "INSERT INTO tm_contacto (cli_id, car_id, con_nom, con_email, con_telf, est) VALUES (?, ?, ?, ?, ?, '1');";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el valor del ID del cliente al primer parámetro de la consulta SQL.
            $sql->bindValue(1, $cli_id);
            
            // TODO: Enlaza el valor del ID del cargo al segundo parámetro de la consulta SQL.
            $sql->bindValue(2, $car_id);
            
            // TODO: Enlaza el valor del nombre del contacto al tercer parámetro de la consulta SQL.
            $sql->bindValue(3, $con_nom);
            
            // TODO: Enlaza el valor del email del contacto al cuarto parámetro de la consulta SQL.
            $sql->bindValue(4, $con_email);
            
            // TODO: Enlaza el valor del teléfono del contacto al quinto parámetro de la consulta SQL.
            $sql->bindValue(5, $con_telf);
            
            // TODO: Ejecuta la consulta SQL preparada para insertar el nuevo contacto.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta (aunque en este caso, no hay datos significativos que devolver).
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para actualizar un contacto existente.
        public function update_contacto($con_id, $cli_id, $car_id, $con_nom, $con_email, $con_telf) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para actualizar el cliente, cargo, nombre, email y teléfono de un contacto específico basado en su `con_id`.
            $sql = "UPDATE tm_contacto SET
                cli_id = ?, 
                car_id = ?, 
                con_nom = ?, 
                con_email = ?, 
                con_telf = ?
                WHERE
                con_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el nuevo ID del cliente al primer parámetro de la consulta.
            $sql->bindValue(1, $cli_id);
            
            // TODO: Enlaza el nuevo ID del cargo al segundo parámetro de la consulta.
            $sql->bindValue(2, $car_id);
            
            // TODO: Enlaza el nuevo nombre del contacto al tercer parámetro de la consulta.
            $sql->bindValue(3, $con_nom);
            
            // TODO: Enlaza el nuevo email del contacto al cuarto parámetro de la consulta.
            $sql->bindValue(4, $con_email);
            
            // TODO: Enlaza el nuevo teléfono del contacto al quinto parámetro de la consulta.
            $sql->bindValue(5, $con_telf);
            
            // TODO: Enlaza el ID del contacto al sexto parámetro de la consulta.
            $sql->bindValue(6, $con_id);
            
            // TODO: Ejecuta la consulta SQL para actualizar el contacto.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para desactivar un contacto (cambia el estado `est` a 0).
        public function delete_contacto($con_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para cambiar el estado (`est`) de un contacto a 0, lo que efectivamente lo desactiva.
            $sql = "UPDATE tm_contacto SET
                est = 0
                WHERE
                con_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del contacto al primer parámetro de la consulta.
            $sql->bindValue(1, $con_id);
            
            // TODO: Ejecuta la consulta SQL para desactivar el contacto.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para obtener los detalles de un contacto por su ID.
        public function get_contacto_x_id($con_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar un contacto específico por su `con_id`.
            $sql = "SELECT * FROM tm_contacto WHERE con_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del contacto al primer parámetro de la consulta.
            $sql->bindValue(1, $con_id);
            
            // TODO: Ejecuta la consulta SQL para obtener el contacto específico.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }

        public function get_contacto_x_nombre($con_email) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar una categoría específica por su `cat_id`.
            $sql = "SELECT * FROM tm_contacto
            WHERE con_email = ?
            AND est=1";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID de la categoría al primer parámetro de la consulta.
            $sql->bindValue(1, $con_email);
            
            // TODO: Ejecuta la consulta SQL para obtener la categoría específica.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }

        public function get_contacto_x_ciente_id($cli_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar un contacto específico por su `con_id`.
            $sql = "SELECT * FROM tm_contacto 
                 WHERE
                cli_id = ?
                AND est=1";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del contacto al primer parámetro de la consulta.
            $sql->bindValue(1, $cli_id);
            
            // TODO: Ejecuta la consulta SQL para obtener el contacto específico.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }
    }

?>
