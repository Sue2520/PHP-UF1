<?php
    session_start();
    $conn = mysqli_connect('localhost','root','','infobdn');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editor de curso</title>
    <script src="https://kit.fontawesome.com/8e7b3076a1.js" crossorigin="anonymous"></script>
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
        ?>

        <h1 id="tituloadmin">Editor de curso</h1>
        <a href="admin.php" class="botones">Volver a administrador</a>

        <?php
        if ($_POST){
            //Trato los datos que me han enviado en el formuario
            $IDcurso = $_POST['IDcurso'];
            $nombre_curso = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $horas = $_POST['horas'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_finalizacion = $_POST['fecha_finalizacion'];
            $dni_prof = $_POST['dni_prof'];

            //Conectarte a la BD
            $sql = "UPDATE cursos SET  nom = '$nombre_curso', descripcio = '$descripcion', horas = $horas, data_inici= '$fecha_inicio', data_final = '$fecha_finalizacion', dni_prof = '$dni_prof' WHERE idCurso = $IDcurso;";
            mysqli_query($conn, $sql);

        }else{
            $IDcurso = $_GET['idCurso'];
            $sql = "SELECT * FROM cursos WHERE idCurso = '$IDcurso'";
            $result = mysqli_query($conn,$sql);

            while($mostrar=mysqli_fetch_array($result)){
        ?>

        <form action="modificar_cursos.php" method="post">
            <input type="text" name="IDcurso" value="<?php echo $mostrar['idCurso']?>" readonly >
            <input type="text" name="nombre" value="<?php echo $mostrar['nom']?>">
            <input type="text" name="descripcion" value="<?php echo $mostrar['descripcio']?>">
            <input type="text" name="horas" value="<?php echo $mostrar['horas']?>">
            <input type="date" min="2022-01-01" max="2022-12-31" name="fecha_inicio" value="<?php echo $mostrar['data_inici']?>">
            <input type="date" min="2022-01-01" max="2022-12-31" name="fecha_finalizacion" value="<?php echo $mostrar['data_final']?>">

            <?php
                $conn = mysqli_connect("localhost", "root", "", "infobdn");
                $query = "SELECT dni_prof FROM professors";
                $consulta = mysqli_query($conn, $query);
                $rows = mysqli_num_rows($consulta);
            ?>

            <select class="seleccionar" name = 'dni_prof'>
                <option value="0">Selecciona un professor</option>
                <?php
                for($i=0;$i<=$rows;$i++){
                    $profeActual = mysqli_fetch_array($consulta);
                    echo "<option value=".$profeActual[0].">".$profeActual[0]."</option>";
                }
                ?>
            </select>

            <input type="submit" value="Send">
        </form>

        <?php
            }
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