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

    <?php require 'header.php';
    ?>

    <h1 id="tituloadmin">Editor de cuenta</h1>
    <a href="alumnos.php" class="botones">Volver a mi curso</a>

    <?php
    if ($_POST){
        //Trato los datos que me han enviado en el formuario
        $DNI_alum = $_POST['DNI_alum'];
        $nombre_alum = $_POST['nombre_alum'];
        $apellido_alum = $_POST['apellido_alum'];
        $contraseña_alum = $_POST['contraseña_alum'];
        $edad_alum = $_POST['edad_alum'];
        $cursos_matriculats = $_POST['cursos_matriculats'];
        $rol_alum = $_POST['rol_alum'];

        //Conectarte a la BD
        $sql = "UPDATE alumnes SET  nombre_alum = '$nombre_alum', apellido_alum = '$apellido_alum', contraseña_alum = $contraseña_alum, edad_alum= '$edad_alum', cursos_matriculats = '$cursos_matriculats', rol_alum = '$rol_alum' WHERE dni_alum = '$DNI_alum'";
        mysqli_query($conn, $sql);

    }else{
        $DNI_alum = $_SESSION['dni'];
        $sql = "SELECT * FROM alumnes WHERE dni_alum = '$DNI_alum'";
        $result = mysqli_query($conn,$sql);

        while($mostrar=mysqli_fetch_array($result)){
    ?>

    <form action="modificar_alumno.php" method="post">
        <input type="text" name="DNI_alum" value="<?php echo $mostrar['dni_alum']?>" readonly >
        <input type="text" name="nombre_alum" value="<?php echo $mostrar['nombre_alum']?>">
        <input type="text" name="apellido_alum" value="<?php echo $mostrar['apellido_alum']?>">
        <input type="text" name="contraseña_alum" value="<?php echo $mostrar['contraseña_alum']?>">
        <input type="text" name="edad_alum" value="<?php echo $mostrar['edad_alum']?>">
        <input type="text" name="cursos_matriculats" value="<?php echo $mostrar['cursos_matriculats']?>">
        <input type="text" name="rol_alum" value="<?php echo $mostrar['rol_alum']?>" readonly>

        <?php
            // $conn = mysqli_connect("localhost", "root", "", "infobdn");
            // $query = "SELECT dni_prof FROM professors";
            // $consulta = mysqli_query($conn, $query);
            // $rows = mysqli_num_rows($consulta);
        ?>

        <!-- <select class="seleccionar" name = 'dni_prof'>
            <option value="0">Selecciona un professor</option>
            <?php
            // for($i=0;$i<=$rows;$i++){
            //     $profeActual = mysqli_fetch_array($consulta);
            //     echo "<option value=".$profeActual[0].">".$profeActual[0]."</option>";
            // }
            ?>
        </select> -->

        <input type="submit" value="Send">
    </form>

    <?php
        }
    } 
    ?>
    

</body>
</html>