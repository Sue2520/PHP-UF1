<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrarse</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php require 'header.php';
     if ($_POST){
        //Trato los datos que me han enviado en el formuario
        $dni_alum = $_POST['DNI'];
        $nombre_alum = $_POST['nombre'];
        $apellido_alum = $_POST['apellido'];
        $edad_alum = $_POST['edad'];
        $cursos_matriculats = $_POST['cursomatriculado'];
        $contraseña_alum = $_POST['password'];

        //Conectarte a la BD
        $conn = mysqli_connect("localhost", "root", "", "infobdn");
        $sql = "INSERT INTO alumnes VALUES ('$dni_alum','$nombre_alum','$apellido_alum','$contraseña_alum','$edad_alum','$cursos_matriculats','rol_alum')";
        mysqli_query($conn, $sql);
        echo "<meta http-equiv='refresh' content='1;url=login.php' />";
    }else{
    ?>

    <h1 id="tituloadmin">Registrarse</h1>
    <span>o <a href="login.php" class="botones">Login</a></span>
    <form action="registrarse.php" method="post">
    <input type="text" name="nombre" placeholder="Nombre">
        <input type="text" name="apellido" placeholder="Apellido">
        <input type="text" name="DNI" placeholder="DNI">
        <input type="text" name="edad" placeholder="Edad">
        <input type="text" name="cursomatriculado" placeholder="Cusos matriculado">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="submit" value="Send">
    </form>

    <?php
    } 
    ?>
</body>
</html>