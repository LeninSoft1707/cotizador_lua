<?php 
    // TODO: Define una clase `Contacto` que hereda de la clase `Conectar`.
    class Producto extends Conectar {

        // TODO: Método para obtener todos los contactos activos (con estado `est=1`).
        public function get_producto() {
            // TODO: Establece la conexión a la base de datos llamando al método `Conexion` de la clase padre (`Conectar`).
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar todos los contactos con estado activo.
            $sql = "SELECT
            tm_producto.prod_id,
            tm_producto.prod_nom,
            tm_producto.prod_descrip,
            tm_producto.prod_precio,
            tm_categoria.cat_id,
            tm_categoria.cat_nom
            FROM tm_producto
            INNER JOIN tm_categoria ON tm_producto.cat_id = tm_categoria.cat_id
            WHERE
            tm_producto.est=1;";
            
            // TODO: Prepara la consulta SQL para evitar inyecciones SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Ejecuta la consulta preparada.
            $sql->execute();
            
            // TODO: Retorna todos los resultados obtenidos de la consulta en un array.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para insertar un nuevo producto en la base de datos.
        public function insert_producto($cat_id, $prod_nom, $prod_descrip, $prod_precio) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define la consulta SQL para insertar un nuevo contacto. `con_id` es auto-incrementado, por lo que se pasa como `NULL`.
            $sql = "INSERT INTO tm_producto (cat_id, prod_nom, prod_descrip, prod_precio, est) VALUES (?, ?, ?, ?, '1');";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el valor del ID del cliente al primer parámetro de la consulta SQL.
            $sql->bindValue(1, $cat_id);
            
            // TODO: Enlaza el valor del ID del cargo al segundo parámetro de la consulta SQL.
            $sql->bindValue(2, $prod_nom);
            
            // TODO: Enlaza el valor del nombre del contacto al tercer parámetro de la consulta SQL.
            $sql->bindValue(3, $prod_descrip);
            
            // TODO: Enlaza el valor del email del contacto al cuarto parámetro de la consulta SQL.
            $sql->bindValue(4, $prod_precio);
            
            // TODO: Ejecuta la consulta SQL preparada para insertar el nuevo contacto.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta (aunque en este caso, no hay datos significativos que devolver).
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para actualizar un contacto existente.
        public function update_producto($prod_id, $cat_id, $prod_nom, $prod_descrip, $prod_precio) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para actualizar el cliente, cargo, nombre, email y teléfono de un contacto específico basado en su `con_id`.
            $sql = "UPDATE tm_producto SET
                cat_id = ?,  
                prod_nom = ?, 
                prod_descrip = ?, 
                prod_precio = ?
                WHERE
                prod_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el nuevo ID del cliente al primer parámetro de la consulta.
            $sql->bindValue(1, $cat_id);
            
            // TODO: Enlaza el nuevo ID del cargo al segundo parámetro de la consulta.
            $sql->bindValue(2, $prod_nom);
            
            // TODO: Enlaza el nuevo nombre del contacto al tercer parámetro de la consulta.
            $sql->bindValue(3, $prod_descrip);
            
            // TODO: Enlaza el nuevo email del contacto al cuarto parámetro de la consulta.
            $sql->bindValue(4, $prod_precio);
            
            // TODO: Enlaza el ID del contacto al sexto parámetro de la consulta.
            $sql->bindValue(5, $prod_id);
            
            // TODO: Ejecuta la consulta SQL para actualizar el contacto.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para desactivar un contacto (cambia el estado `est` a 0).
        public function delete_producto($prod_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para cambiar el estado (`est`) de un contacto a 0, lo que efectivamente lo desactiva.
            $sql = "UPDATE tm_producto SET
                est = 0
                WHERE
                prod_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del contacto al primer parámetro de la consulta.
            $sql->bindValue(1, $prod_id);
            
            // TODO: Ejecuta la consulta SQL para desactivar el contacto.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para obtener los detalles de un contacto por su ID.
        public function get_producto_x_id($prod_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar un contacto específico por su `con_id`.
            $sql = "SELECT * FROM tm_producto WHERE prod_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del contacto al primer parámetro de la consulta.
            $sql->bindValue(1, $prod_id);
            
            // TODO: Ejecuta la consulta SQL para obtener el contacto específico.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }

            // TODO: Método para obtener los detalles de una Porducto por su Nombre.
        public function get_producto_x_nombre($prod_nom) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar una categoría específica por su `cat_id`.
            $sql = "SELECT * FROM tm_producto
            WHERE prod_nom = ?
            AND est=1";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID de la categoría al primer parámetro de la consulta.
            $sql->bindValue(1, $prod_nom);
            
            // TODO: Ejecuta la consulta SQL para obtener la categoría específica.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para obtener los detalles de una categoría por su Nombre.
        public function get_producto_x_categoria($cat_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar una categoría específica por su `cat_id`.
            $sql = "SELECT * FROM tm_producto
            WHERE cat_id = ?
            AND est=1";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID de la categoría al primer parámetro de la consulta.
            $sql->bindValue(1, $cat_id);
            
            // TODO: Ejecuta la consulta SQL para obtener la categoría específica.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }
    }

?>
