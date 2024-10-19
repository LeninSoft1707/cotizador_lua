<?php 
    // TODO: Define una clase `Cotizacion` que hereda de la clase `Conectar`.
    class Cotizacion extends Conectar {



        // TODO: Método para insertar una nueva empresa en la base de datos.
        public function insert_cotizacion($cli_id, $con_id, $cli_ruc, $con_telf, $con_email, $cot_descrip, $usu_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define la consulta SQL para insertar una nueva empresa. `emp_id` es auto-incrementado, por lo que se pasa como `NULL`.
            $sql = "CALL sp_i_cotizacion_001(?, ?, ?, ?, ?, ?, ?);";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el valor del nombre de la empresa al primer parámetro de la consulta SQL.
            $sql->bindValue(1, $cli_id);
            
            // TODO: Enlaza el valor del porcentaje de la empresa al segundo parámetro de la consulta SQL.
            $sql->bindValue(2, $con_id);
            $sql->bindValue(3, $cli_ruc);
            $sql->bindValue(4, $con_telf);
            $sql->bindValue(5, $con_email);
            $sql->bindValue(6, $cot_descrip);
            $sql->bindValue(7, $usu_id);
            
            // TODO: Ejecuta la consulta SQL preparada para insertar la nueva empresa.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta (aunque en este caso, no hay datos significativos que devolver).
            return $resultado = $sql->fetchAll();
        }
        
        // TODO: Método para insertar una nueva empresa en la base de datos.
        public function insert_dcotizacion(
            $cot_id, 
            $cat_id, 
            $prod_id, 
            $cotd_precio, 
            $cotd_cant,
            $cotd_tipo
            ) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define la consulta SQL para insertar una nueva empresa. `emp_id` es auto-incrementado, por lo que se pasa como `NULL`.
            $sql = "CALL sp_i_cotizacion_002(?, ?, ?, ?, ?, ?);";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el valor del nombre de la empresa al primer parámetro de la consulta SQL.
            $sql->bindValue(1, $cot_id);
            
            // TODO: Enlaza el valor del porcentaje de la empresa al segundo parámetro de la consulta SQL.
            $sql->bindValue(2, $cat_id);
            $sql->bindValue(3, $prod_id);
            $sql->bindValue(4, $cotd_precio);
            $sql->bindValue(5, $cotd_cant);
            $sql->bindValue(6, $cotd_tipo);
            
            // TODO: Ejecuta la consulta SQL preparada para insertar la nueva empresa.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta (aunque en este caso, no hay datos significativos que devolver).
            return $resultado = $sql->fetchAll();
        }
        
        public function get_cotizacion($cot_id){
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
        
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para cambiar el estado (`est`) de un contacto a 0, lo que efectivamente lo desactiva.
            $sql = "CALL sp_l_cotizacion_001 (?)";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del contacto al primer parámetro de la consulta.
            $sql->bindValue(1, $cot_id);
            
            // TODO: Ejecuta la consulta SQL para desactivar el contacto.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para obtener todas las empresas activas (con estado `est=1`).
        public function get_dcotizacion($cot_id, $cotd_tipo) {
            // TODO: Establece la conexión a la base de datos llamando al método `Conexion` de la clase padre (`Conectar`).
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar todas las empresas con estado activo.
            $sql = "SELECT 
                    td_cotizacion.cotd_id,
                    td_cotizacion.cot_id,
                    td_cotizacion.cat_id,
                    tm_categoria.cat_nom, -- suponer que tm_categoria tiene un campo 'cat_nombre'
                    td_cotizacion.prod_id,
                    tm_producto.prod_nom, -- suponer que tm_producto tiene un campo 'prod_nombre'
                    tm_producto.prod_descrip, 
                    td_cotizacion.cotd_precio,
                    td_cotizacion.cotd_cant,
                    td_cotizacion.cotd_profit,
                    td_cotizacion.cotd_subtotal,
                    td_cotizacion.cotd_total
                    
                    FROM td_cotizacion
                    INNER JOIN 
                    tm_categoria ON td_cotizacion.cat_id = tm_categoria.cat_id
                    INNER JOIN 
                    tm_producto ON td_cotizacion.prod_id = tm_producto.prod_id
                    WHERE
                    td_cotizacion.cot_id = ?
                    AND td_cotizacion.cotd_tipo = ?
                    AND td_cotizacion.est = 1";
            
            // TODO: Prepara la consulta SQL para evitar inyecciones SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el valor del nombre de la empresa al primer parámetro de la consulta SQL.
            $sql->bindValue(1, $cot_id);
            $sql->bindValue(2, $cotd_tipo);
            
            // TODO: Ejecuta la consulta preparada.
            $sql->execute();
            
            // TODO: Retorna todos los resultados obtenidos de la consulta en un array.
            return $resultado = $sql->fetchAll();
        }

        //TODO: Metodo para obtener los detalles de la cotizacion x cotd_id
        public function get_dcotizacion_x_cotd_id($cotd_id){
            // TODO: Establece la conexión a la base de datos llamando al método `Conexion` de la clase padre (`Conectar`).
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar todas las empresas con estado activo.
            $sql = "SELECT 
                    td_cotizacion.cotd_id,
                    td_cotizacion.cot_id,
                    td_cotizacion.cat_id,
                    tm_categoria.cat_nom, -- suponer que tm_categoria tiene un campo 'cat_nombre'
                    td_cotizacion.prod_id,
                    tm_producto.prod_nom, -- suponer que tm_producto tiene un campo 'prod_nombre'
                    td_cotizacion.cotd_precio,
                    td_cotizacion.cotd_cant,
                    td_cotizacion.cotd_profit,
                    td_cotizacion.cotd_total
                    
                    FROM td_cotizacion
                    INNER JOIN 
                    tm_categoria ON td_cotizacion.cat_id = tm_categoria.cat_id
                    INNER JOIN 
                    tm_producto ON td_cotizacion.prod_id = tm_producto.prod_id
                    WHERE
                    td_cotizacion.cotd_id = ?
                    AND td_cotizacion.est = 1";
            
            // TODO: Prepara la consulta SQL para evitar inyecciones SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el valor del nombre de la empresa al primer parámetro de la consulta SQL.
            $sql->bindValue(1, $cotd_id);
            
            // TODO: Ejecuta la consulta preparada.
            $sql->execute();
            
            // TODO: Retorna todos los resultados obtenidos de la consulta en un array.
            return $resultado = $sql->fetchAll();
        }
        //TODO: Metodo para eliminar registros del paso 2
        public function delete_dcotizacion($cotd_id, $cot_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
        
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para cambiar el estado (`est`) de un contacto a 0, lo que efectivamente lo desactiva.
            $sql = "call sp_d_cotizacion_001 (?,?);";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del contacto al primer parámetro de la consulta.
            $sql->bindValue(1, $cotd_id);
            $sql->bindValue(2, $cot_id);
            
            // TODO: Ejecuta la consulta SQL para desactivar el contacto.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = true;
        }

        public function update_dcotizacion(
            $cotd_id, 
            $cotd_precio, 
            $cotd_cantidad, 
            $cotd_profit, 
            $cot_id
            ) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
        
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para cambiar el estado (`est`) de un contacto a 0, lo que efectivamente lo desactiva.
            $sql = "CALL sp_u_cotizacion_001 (?,?,?,?,?);";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del contacto al primer parámetro de la consulta.
            $sql->bindValue(1, $cotd_id);
            $sql->bindValue(2, $cotd_precio);
            $sql->bindValue(3, $cotd_cantidad);
            $sql->bindValue(4, $cotd_profit);
            $sql->bindValue(5, $cot_id);
            
            // TODO: Ejecuta la consulta SQL para desactivar el contacto.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        public function update_cotizacion(
            $cot_id, 
            $cot_saludo, 
            $cot_adicional, 
            $cot_contrato 
            ) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
        
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para cambiar el estado (`est`) de un contacto a 0, lo que efectivamente lo desactiva.
            $sql = "CALL sp_u_cotizacion_002 (?,?,?,?);";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del contacto al primer parámetro de la consulta.
            $sql->bindValue(1, $cot_id);
            $sql->bindValue(2, $cot_saludo);
            $sql->bindValue(3, $cot_adicional);
            $sql->bindValue(4, $cot_contrato);
            
            // TODO: Ejecuta la consulta SQL para desactivar el contacto.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        public function update_cotizacion_visto($cot_id){
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
        
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para cambiar el estado (`est`) de un contacto a 0, lo que efectivamente lo desactiva.
            $sql = "CALL sp_u_cotizacion_003 (?)";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del contacto al primer parámetro de la consulta.
            $sql->bindValue(1, $cot_id);
            
            // TODO: Ejecuta la consulta SQL para desactivar el contacto.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        public function update_cotizacion_estado($cot_id, $cot_tipo){
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
        
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para cambiar el estado (`est`) de un contacto a 0, lo que efectivamente lo desactiva.
            $sql = "CALL sp_u_cotizacion_004 (?,?)";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del contacto al primer parámetro de la consulta.
            $sql->bindValue(1, $cot_id);
            $sql->bindValue(2, $cot_tipo);

            // TODO: Ejecuta la consulta SQL para desactivar el contacto.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        public function get_cotizacion_x_usuario($usu_id){
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
        
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para cambiar el estado (`est`) de un contacto a 0, lo que efectivamente lo desactiva.
            $sql = "CALL sp_l_cotizacion_002 (?)";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del contacto al primer parámetro de la consulta.
            $sql->bindValue(1, $usu_id);
            
            // TODO: Ejecuta la consulta SQL para desactivar el contacto.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }
    }


?>