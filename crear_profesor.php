<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crear profesor</title>
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
            $dni_prof = $_POST['dni_prof'];
            $nombre_profesor = $_POST['nombre'];
            $apellido_profesor = $_POST['apellido'];
            $pass_profesor = $_POST['pass'];
            $titulo = $_POST['titulo'];
            $curso = $_POST['curso'];
            $fotografia = "img/$dni_prof.jpg";
            echo $_FILES['fotografia']['tmp_name'];

        //Conectarte a la BD
            $conn = mysqli_connect("localhost", "root", "", "infobdn");
            $sql = "INSERT INTO professors VALUES ('$dni_prof','$nombre_profesor','$apellido_profesor','$pass_profesor','$titulo','$fotografia','$curso','$act')";
            mysqli_query($conn, $sql);

            if (is_uploaded_file ($_FILES['fotografia']['tmp_name']))
            {
                $nombreDirectorio = "img/$dni_prof.jpg";
                //filtrar que solo se puedan ver imagenes y ver el tipo de img como .jpg .png etc...
                move_uploaded_file ($_FILES['fotografia']['tmp_name'],$nombreDirectorio);
            }
            else{
                print ("No se ha podido subir el fichero\n");
            }


        }else{
        ?>

        <h1 id="tituloadmin">Creando un profesor</h1>
        <form action="crear_profesor.php" method="post" ENCTYPE="multipart/form-data">
            <input type="text" name="dni_prof" placeholder="dni_prof">
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="text" name="apellido" placeholder="apellido">
            <input type="text" name="pass" placeholder="pass">
            <input type="text" name="titulo" placeholder="titulo academico">
            <input type="file" name="fotografia" placeholder="foto">

            <?php
            $conn = mysqli_connect("localhost", "root", "", "infobdn");
            $query = "SELECT nom FROM cursos";
            $consulta = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($consulta);
            ?>

            <select class="seleccionar" name = 'curso'>
                <option value="0">Selecciona un curso</option>
                <?php
                for($i=0;$i<=$rows;$i++){
                    $cursoActual = mysqli_fetch_array($consulta);
                    echo "<option value=".$cursoActual[0].">".$cursoActual[0]."</option>";
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