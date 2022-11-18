<?php
    session_start();
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
    require "funciones.php";
    if(!isset($_SESSION['rol'])) {
        echo "No estás autorizado a ver esta página.";
        echo "<meta http-equiv='refresh' content='2;url=administrador.php' />";
    }
    else {
        if(validarAdmin($_SESSION['rol'])) {

        require 'header.php';
        if ($_POST){
            //Trato los datos que me han enviado en el formuario
            $nombre_curso = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $horas = $_POST['horas'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_finalizacion = $_POST['fecha_finalizacion'];
            $dni_prof = $_POST['dni_prof'];

            //Conectarte a la BD
            $conn = mysqli_connect("localhost", "root", "", "infobdn");
            $sql = "INSERT INTO cursos VALUES ('DEFAULT','$nombre_curso','$descripcion',$horas,'$fecha_inicio','$fecha_finalizacion','$dni_prof', 1)";
            echo $sql;
            mysqli_query($conn, $sql);
            echo "<meta http-equiv='refresh' content='1;url=cursos.php' />";
        }else{
        ?>

        <h1 id="tituloadmin">Creando un cursos</h1>
        <form action="crear_curso.php" method="post">
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="text" name="descripcion" placeholder="descripcion">
            <input type="text" name="horas" placeholder="horas">
            <input type="date" min="2022-01-01" max="2022-12-31" name="fecha_inicio" placeholder="fecha_inicio">
            <input type="date" min="2022-01-01" max="2022-12-31" name="fecha_finalizacion" placeholder="fecha_finalizacion">

            <?php
            $conn = mysqli_connect("localhost", "root", "", "infobdn");
            $query = "SELECT dni_prof,nom FROM professors";
            $consulta = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($consulta);
            ?>

            <select class="seleccionar" name = 'dni_prof'>
                <option value="0">Selecciona un professor</option>
                <?php
                for($i=0;$i<=$rows;$i++){
                    $profeActual = mysqli_fetch_array($consulta);
                    echo "<option value=".$profeActual[0].">".$profeActual[0]." - ".$profeActual[1]."</option>";
                }
                ?>
            </select>
            
            <input type="submit" value="Send">
        </form>

        <?php
        } 
        ?>
    <?php 
        }
        else {
            echo "No estás autorizado a ver esta página";
            echo "<meta http-equiv='refresh' content='2;url=administrador.php' />";
        }

    }
    ?>

</body>
</html>