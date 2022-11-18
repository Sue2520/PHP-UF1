<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php 
    require 'header.php';
    if ($_POST){
        //Trato los datos que me han enviado en el formuario
        $dni_alum = $_POST['DNI'];
        $contraseña_alum = $_POST['password'];
        var_dump($_POST);

        //Conectarte a la BD
        $conn = mysqli_connect("localhost", "root", "", "infobdn");
        $sql = "SELECT * FROM alumnes WHERE dni_alum = '$dni_alum' and contraseña_alum = '$contraseña_alum'";
        $consulta = mysqli_query($conn, $sql);
        $NOMBRE= mysqli_fetch_row($consulta);
        var_dump($NOMBRE);
        if (mysqli_num_rows( $consulta )>0){
            $_SESSION['nombre']= $NOMBRE[1];
            $_SESSION['dni']=  $dni_alum;
            $_SESSION['tipo'] = "A";
            echo "<meta http-equiv='refresh' content='0;url=alumnos.php' />";
            ?>
        <?php
        }
        else{
            $dni_prof = $_POST['DNI'];
            $pass = $_POST['password'];
            var_dump($_POST);

            $sql = "SELECT * FROM professors WHERE dni_prof = '$dni_prof' and pass = '$pass'";
            $consulta = mysqli_query($conn, $sql);
            $NOMBRE= mysqli_fetch_row($consulta);
            if (mysqli_num_rows( $consulta )>0){
                $_SESSION['nombre']= $NOMBRE[1];
                $_SESSION['dni']=  $dni_prof;
                $_SESSION['tipo'] = "B";
                echo "<meta http-equiv='refresh' content='0;url=area_profesor.php' />";
            }else{
            echo "No estás autorizado";
            // echo "<meta http-equiv='refresh' content='3;url=login.php' />";
            }
        }

    }else{
    ?>

    <h1 id="tituloadmin">Login</h1>
    <span>o <a href="Registrarse.php" class="botones">Registrate</a></span>
    <form action="login.php" method="post">
        <input type="text" name="DNI" placeholder="Enter your DNI">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="submit" value="Send">
    </form>

    <?php
        }
    ?>
</body>
</html>