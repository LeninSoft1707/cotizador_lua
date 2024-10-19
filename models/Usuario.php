<?php 
    // TODO: Define una clase `Usuario` que hereda de la clase `Conectar`.
    class Usuario extends Conectar {

        public function login(){ 
            // TODO: Establece la conexión a la base de datos llamando al método Conexion de la clase padre (Conectar).
            // El método `Conexion` probablemente abre una conexión a la base de datos y la devuelve para ser utilizada en este método.
            $conectar = parent::conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            // `set_names()` asegura que las consultas y la base de datos interpreten correctamente los caracteres especiales, evitando problemas con acentos u otros símbolos.
            parent::set_names();
        
            // TODO: Verifica si el formulario de login ha sido enviado.
            // Este `if` comprueba si la solicitud POST contiene la clave "enviar", lo cual significa que el usuario ha intentado iniciar sesión.
            if (isset($_POST["enviar"])){
        
                // TODO: Captura los valores de los campos de correo electrónico y contraseña del formulario.
                // Se extraen los valores de `usu_correo` y `usu_pass` del formulario HTML usando el método `$_POST`.
                $correo = $_POST["usu_correo"];
                $pass = $_POST["usu_pass"];
        
                // TODO: Valida si los campos de correo y contraseña están vacíos.
                // Si ambos campos están vacíos, redirige al usuario a la página de inicio de sesión con un mensaje de error (parámetro `m=2`).
                if(empty($correo) and empty($pass)){
                    header("Location:".conectar::ruta()."/index.php?m=2");
                }else{
        
                    // TODO: Prepara una consulta SQL para evitar inyecciones SQL.
                    // Se utiliza una consulta preparada para evitar que el usuario inyecte código malicioso en el formulario, utilizando `?` como marcadores de posición para los parámetros.
                    $sql = "SELECT * FROM tm_usuario WHERE usu_correo=? and usu_pass=?";
                    $sql = $conectar->prepare($sql);
        
                    // TODO: Enlaza el valor del correo del usuario al primer parámetro de la consulta SQL.
                    // `bindValue()` asegura que el correo se asocie al primer marcador de la consulta (`?`).
                    $sql->bindValue(1, $correo);
                
                    // TODO: Enlaza el valor de la contraseña del usuario al segundo parámetro de la consulta SQL.
                    // De igual forma, `bindValue()` enlaza la contraseña al segundo marcador de la consulta (`?`).
                    $sql->bindValue(2, $pass);
        
                    // TODO: Ejecuta la consulta SQL preparada.
                    // `execute()` corre la consulta SQL con los valores proporcionados.
                    $sql->execute();
        
                    // TODO: Obtiene los resultados de la consulta SQL.
                    // `fetch()` devuelve la primera fila de resultados. Si no hay coincidencias, devolverá `false`.
                    $resultado = $sql->fetch();
        
                    // TODO: Verifica si la consulta devolvió un array con datos.
                    // Si la variable `$resultado` es un array y contiene datos, significa que las credenciales son válidas.
                    if(is_array($resultado) and count($resultado)>0){
        
                        // TODO: Inicia la sesión del usuario guardando información relevante en variables de sesión.
                        // Se almacenan el ID, nombre y correo electrónico del usuario en variables de sesión para mantener al usuario autenticado.
                        $_SESSION["usu_id"] = $resultado["usu_id"];
                        $_SESSION["usu_nom"] = $resultado["usu_nom"];
                        $_SESSION["usu_correo"] = $resultado["usu_correo"];
        
                        // TODO: Redirige al usuario al dashboard o página de inicio tras un login exitoso.
                        // Se utiliza `Conectar::ruta()` para generar la URL de redirección a la página de inicio (`view/Home`), probablemente una ruta protegida.
                        header("Location:".Conectar::ruta()."view/Home");
                        exit();
        
                    }else{
                        // TODO: Redirige al usuario a la página de inicio de sesión con un mensaje de error.
                        // Si no se encuentran resultados (usuario no existe o credenciales incorrectas), se redirige con un mensaje de error (`m=1`).
                        header("Location:".Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        }
        

        // TODO: Método para obtener todos los usuarios activos (con estado `est=1`).
        public function get_usuario() {
            // TODO: Establece la conexión a la base de datos llamando al método `Conexion` de la clase padre (`Conectar`).
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar todos los usuarios con estado activo.
            $sql = "SELECT * FROM tm_usuario WHERE est=1;";
            
            // TODO: Prepara la consulta SQL para evitar inyecciones SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Ejecuta la consulta preparada.
            $sql->execute();
            
            // TODO: Retorna todos los resultados obtenidos de la consulta en un array.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para insertar un nuevo usuario en la base de datos.
        public function insert_usuario($usu_correo, $usu_nom, $usu_pass) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define la consulta SQL para insertar un nuevo usuario. `usu_id` es auto-incrementado, por lo que se pasa como `NULL`.
            $sql = "INSERT INTO tm_usuario (usu_correo, usu_nom, usu_pass, est) VALUES (?, ?, ?, '1');";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el valor del correo del usuario al primer parámetro de la consulta SQL.
            $sql->bindValue(1, $usu_correo);
            
            // TODO: Enlaza el valor del nombre del usuario al segundo parámetro de la consulta SQL.
            $sql->bindValue(2, $usu_nom);
            
            // TODO: Enlaza el valor de la contraseña del usuario al tercer parámetro de la consulta SQL.
            $sql->bindValue(3, $usu_pass);
            
            // TODO: Ejecuta la consulta SQL preparada para insertar el nuevo usuario.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta (aunque en este caso, no hay datos significativos que devolver).
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para actualizar un usuario existente.
        public function update_usuario($usu_id, $usu_correo, $usu_nom, $usu_pass) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para actualizar el correo, nombre y contraseña de un usuario específico basado en su `usu_id`.
            $sql = "UPDATE tm_usuario SET
                usu_correo = ?, 
                usu_nom = ?, 
                usu_pass = ?
                WHERE
                usu_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el nuevo correo del usuario al primer parámetro de la consulta.
            $sql->bindValue(1, $usu_correo);
            
            // TODO: Enlaza el nuevo nombre del usuario al segundo parámetro de la consulta.
            $sql->bindValue(2, $usu_nom);
            
            // TODO: Enlaza la nueva contraseña del usuario al tercer parámetro de la consulta.
            $sql->bindValue(3, $usu_pass);
            
            // TODO: Enlaza el ID del usuario al cuarto parámetro de la consulta.
            $sql->bindValue(4, $usu_id);
            
            // TODO: Ejecuta la consulta SQL para actualizar el usuario.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para desactivar un usuario (cambia el estado `est` a 0).
        public function delete_usuario($usu_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para cambiar el estado (`est`) de un usuario a 0, lo que efectivamente lo desactiva.
            $sql = "UPDATE tm_usuario SET
                est = 0
                WHERE
                usu_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del usuario al primer parámetro de la consulta.
            $sql->bindValue(1, $usu_id);
            
            // TODO: Ejecuta la consulta SQL para desactivar el usuario.
            $sql->execute();
            
            // TODO: Retorna el resultado de la consulta.
            return $resultado = $sql->fetchAll();
        }

        // TODO: Método para obtener los detalles de un usuario por su ID.
        public function get_usuario_x_id($usu_id) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar un usuario específico por su `usu_id`.
            $sql = "SELECT * FROM tm_usuario WHERE usu_id = ?";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID del usuario al primer parámetro de la consulta.
            $sql->bindValue(1, $usu_id);
            
            // TODO: Ejecuta la consulta SQL para obtener el usuario específico.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }

        public function get_usuario_x_nombre($usu_correo) {
            // TODO: Establece la conexión a la base de datos.
            $conectar = parent::Conexion();
            
            // TODO: Configura el conjunto de caracteres de la conexión a UTF-8.
            parent::set_names();
            
            // TODO: Define una consulta SQL para seleccionar una categoría específica por su `cat_id`.
            $sql = "SELECT * FROM tm_usuario
            WHERE usu_correo = ?
            AND est=1";
            
            // TODO: Prepara la consulta SQL.
            $sql = $conectar->prepare($sql);
            
            // TODO: Enlaza el ID de la categoría al primer parámetro de la consulta.
            $sql->bindValue(1, $usu_correo);
            
            // TODO: Ejecuta la consulta SQL para obtener la categoría específica.
            $sql->execute();
            
            // TODO: Retorna los resultados de la consulta.
            return $resultado = $sql->fetchAll();
        }
    }

?>
