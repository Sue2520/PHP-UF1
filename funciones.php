<?php


            function validarAdmin($rol) {
                if($rol == 0) {
                    return true;
                }else {
                    return false;
                }
            }

            function validarAlumno($rol) {
                if($rol == 1) {
                    return true;
                }else {
                    return false;
                }
            }

            function conectDB() {
                $server = "localhost";
                $user = "root";
                $pass = "";
                $bd = "infobdn"; 

                $conexion = mysqli_connect($server,$user,$pass,$bd)
                    or die("No se ha podido conectar a la base de datos");
                return $conexion;
            }

            function login($username,$password) {

                $conexion = conectDB();
                $query = "SELECT * FROM administracio WHERE nombre LIKE '$username' AND password LIKE '".md5($password)."' ";
                $resultado = mysqli_query($conexion, $query);
                if(mysqli_num_rows($resultado) == 1) {

                    $_SESSION['nombre'] = $username;
                    $_SESSION['password'] = md5($password);
                    $_SESSION['rol'] = 0;
                    echo "<meta http-equiv='refresh' content='0;url=admin.php' />";
                }else {
                    echo "La contraseña o usuario son incorrectos";
                    echo "<meta http-equiv='refresh' content='3;url=administrador.php' />";
                }
            }

?>