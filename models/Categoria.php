<?php 
    // TODO: Define una clase `Categoria` que hereda de la clase `Conectar`.
    class Categoria extends Conectar {

        // TODO: Método para obtener todas las categorías activas (con estado `est=1`).
        public function get_categoria() {
            // TODO: Establece la conexión a la base de datos llamando al método `Conexion` de la clase padre (`Conectar`).
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar todas las categorías con estado activo.
            $sql = "SELECT * FROM tm_categoria WHERE est=1;";
            
            // TODO: Prepara la consulta SQL para evitar inyecciones SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Ejecuta la consulta preparada.
            $sql->execute();
            
            // TODO: Retorna todos los resultados obtenidos de la consulta en un array.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para insertar una nueva categoría en la base de datos.
        public function insert_categoria($cat_nom, $cat_descrip) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define la consulta SQL para insertar una nueva categoría. `cat_id` es auto-incrementado, por lo que se pasa como `NULL`. Los valores para `cat_nom` y `cat_descrip` se enlazan luego.
            $sql = "INSERT INTO tm_categoria (cat_id, cat_nom, cat_descrip, est) VALUES (NULL, ?, ?, '1');";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el valor del nombre de la categoría al primer parámetro de la consulta SQL.
            $sql->bindValue(1, $cat_nom);
            
            // TODO: Enlaza el valor de la descripción de la categoría al segundo parámetro de la consulta SQL.
            $sql->bindValue(2, $cat_descrip);
            
            // TODO: Ejecuta la consulta SQL preparada para insertar la nueva categoría.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta (aunque en este caso, no hay datos significativos que devolver).
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para actualizar una categoría existente.
        public function update_categoria($cat_id, $cat_nom, $cat_descrip) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para actualizar el nombre y la descripción de una categoría específica basada en su `cat_id`.
            $sql = "UPDATE tm_categoria set
                cat_nom = ?, 
                cat_descrip = ?
                WHERE
                cat_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el nuevo nombre de la categoría al primer parámetro de la consulta.
            $sql->bindValue(1, $cat_nom);
            
            // TODO: Enlaza la nueva descripción de la categoría al segundo parámetro de la consulta.
            $sql->bindValue(2, $cat_descrip);
            
            // TODO: Enlaza el ID de la categoría al tercer parámetro de la consulta.
            $sql->bindValue(3, $cat_id);
            
            // TODO: Ejecuta la consulta SQL para actualizar la categoría.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para desactivar una categoría (cambia el estado `est` a 0).
        public function delete_categoria($cat_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para cambiar el estado (`est`) de una categoría a 0, lo que efectivamente la desactiva.
            $sql = "UPDATE tm_categoria set
                est = 0
                WHERE
                cat_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID de la categoría al primer parámetro de la consulta.
            $sql->bindValue(1, $cat_id);
            
            // TODO: Ejecuta la consulta SQL para desactivar la categoría.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetch();
        }

        // TODO: Método para obtener los detalles de una categoría por su ID.
        public function get_categoria_x_id($cat_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar una categoría específica por su `cat_id`.
            $sql = "SELECT * FROM tm_categoria WHERE cat_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID de la categoría al primer parámetro de la consulta.
            $sql->bindValue(1, $cat_id);
            
            // TODO: Ejecuta la consulta SQL para obtener la categoría específica.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para obtener los detalles de una categoría por su Nombre.
        public function get_categoria_x_nombre($cat_nom) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar una categoría específica por su `cat_id`.
            $sql = "SELECT * FROM tm_categoria
            WHERE cat_nom = ?
            AND est=1";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID de la categoría al primer parámetro de la consulta.
            $sql->bindValue(1, $cat_nom);
            
            // TODO: Ejecuta la consulta SQL para obtener la categoría específica.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }
    }

?>
