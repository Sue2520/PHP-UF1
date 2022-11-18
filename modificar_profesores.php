<?php
    session_start();
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
                $dni_prof = $_POST['dni_prof'];
                $nom_prof = $_POST['nom'];
                $cognom_prof = $_POST['cognom'];
                $pass_prof = $_POST['pass'];
                $titol_academic = $_POST['titol_academic'];
                $cursos_imparteixen = $_POST['cursos_imparteixen'];

                //Conectarte a la BD
                $conn = mysqli_connect('localhost','root','','infobdn');
                $sql = "UPDATE professors SET nom = '$nom_prof', cognom = '$cognom_prof', pass = $pass_prof, titol_academic= '$titol_academic', cursos_imparteixen = '$cursos_imparteixen' WHERE dni_prof = '$dni_prof'";
                echo $sql;
                mysqli_query($conn, $sql);

            }else{
                $conn = mysqli_connect('localhost','root','','infobdn');
                $dni_prof = $_GET['dni_prof'];
                $sql = "SELECT * FROM professors WHERE dni_prof = '$dni_prof'";
                $result = mysqli_query($conn,$sql);

                while($mostrar=mysqli_fetch_array($result)){
            ?>

            <form action="modificar_profesores.php" method="post">
                <input type="text" name="dni_prof" value="<?php echo $mostrar['dni_prof']?>" readonly >
                <input type="text" name="nom" value="<?php echo $mostrar['nom']?>">
                <input type="text" name="cognom" value="<?php echo $mostrar['cognom']?>">
                <input type="text" name="pass" value="<?php echo $mostrar['pass']?>">
                <input type="text" name="titol_academic" value="<?php echo $mostrar['titol_academic']?>">
                
                <?php
                $conn = mysqli_connect("localhost", "root", "", "infobdn");
                $query = "SELECT nom FROM cursos";
                $consulta = mysqli_query($conn, $query);
                $rows = mysqli_num_rows($consulta);
                ?>

                <select class="seleccionar" name = 'cursos_imparteixen'>
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
            } 
                ?>
            </table>
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