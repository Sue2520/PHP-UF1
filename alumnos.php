<?php
    session_start();
    $conexion=mysqli_connect('localhost','root','','infobdn');
?>

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

    <?php 
    require 'header.php';
    if (isset($_SESSION['dni']) && $_SESSION['tipo'] =='A' ){

        
    }else{

    }

   ?>
       
    <h1>Alumnos</h1>
    <a href="modificar_alumno.php" class="botones">Modificar cuenta</a>
        <?php
            $sql="SELECT * FROM alumnes WHERE dni_alum = '".$_SESSION['dni']."'";

            $result=mysqli_query($conexion,$sql);

            while($mostrar=mysqli_fetch_row($result)){
                $array[]=$mostrar;
            }
            
            ?>



</body>
</html>