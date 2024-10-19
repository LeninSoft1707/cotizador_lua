<?php 
    // TODO: Define una clase `Empresa` que hereda de la clase `Conectar`.
    class Empresa extends Conectar {

        // TODO: Método para obtener todas las empresas activas (con estado `est=1`).
        public function get_empresa() {
            // TODO: Establece la conexión a la base de datos llamando al método `Conexion` de la clase padre (`Conectar`).
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar todas las empresas con estado activo.
            $sql = "SELECT * FROM tm_empresa WHERE est=1;";
            
            // TODO: Prepara la consulta SQL para evitar inyecciones SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Ejecuta la consulta preparada.
            $sql->execute();
            
            // TODO: Retorna todos los resultados obtenidos de la consulta en un array.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para insertar una nueva empresa en la base de datos.
        public function insert_empresa($emp_nom, $emp_porcen) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define la consulta SQL para insertar una nueva empresa. `emp_id` es auto-incrementado, por lo que se pasa como `NULL`.
            $sql = "INSERT INTO tm_empresa (emp_nom, emp_porcen, est) VALUES (?, ?,'1');";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el valor del nombre de la empresa al primer parámetro de la consulta SQL.
            $sql->bindValue(1, $emp_nom);
            
            // TODO: Enlaza el valor del porcentaje de la empresa al segundo parámetro de la consulta SQL.
            $sql->bindValue(2, $emp_porcen);
            
            // TODO: Ejecuta la consulta SQL preparada para insertar la nueva empresa.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta (aunque en este caso, no hay datos significativos que devolver).
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para actualizar una empresa existente.
        public function update_empresa($emp_id, $emp_nom, $emp_porcen) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para actualizar el nombre y el porcentaje de una empresa específica basada en su `emp_id`.
            $sql = "UPDATE tm_empresa set
                emp_nom = ?, 
                emp_porcen = ?
                WHERE
                emp_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el nuevo nombre de la empresa al primer parámetro de la consulta.
            $sql->bindValue(1, $emp_nom);
            
            // TODO: Enlaza el nuevo porcentaje de la empresa al segundo parámetro de la consulta.
            $sql->bindValue(2, $emp_porcen);
            
            // TODO: Enlaza el ID de la empresa al tercer parámetro de la consulta.
            $sql->bindValue(3, $emp_id);
            
            // TODO: Ejecuta la consulta SQL para actualizar la empresa.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para eliminaar una empresa de la base da Datos.
        public function delete_empresa($emp_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para cambiar el estado (`est`) de una empresa a 0, lo que efectivamente la desactiva.
            $sql = "UPDATE tm_empresa set
                est = 0
                WHERE
                emp_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID de la empresa al primer parámetro de la consulta.
            $sql->bindValue(1, $emp_id);
            
            // TODO: Ejecuta la consulta SQL para desactivar la empresa.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para obtener los detalles de una empresa por su ID.
        public function get_empresa_x_id($emp_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar una empresa específica por su `emp_id`.
            $sql = "SELECT * FROM tm_empresa WHERE emp_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID de la empresa al primer parámetro de la consulta.
            $sql->bindValue(1, $emp_id);
            
            // TODO: Ejecuta la consulta SQL para obtener la empresa específica.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }

        public function get_empresa_x_nombre($emp_nom) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar una categoría específica por su `cat_id`.
            $sql = "SELECT * FROM tm_empresa
            WHERE emp_nom = ?
            AND est=1";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID de la categoría al primer parámetro de la consulta.
            $sql->bindValue(1, $emp_nom);
            
            // TODO: Ejecuta la consulta SQL para obtener la categoría específica.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }
    }

?>
