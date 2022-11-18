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
    require "funciones.php";
    if(!isset($_SESSION['rol'])) {
        echo "No estás autorizado a ver esta página.";
        echo "<meta http-equiv='refresh' content='2;url=administrador.php' />";
    }
    else {
        if(validarAdmin($_SESSION['rol'])) {
            // var_dump($_SESSION);
            require 'header.php';
            ?>
            
            <h1 id="tituloadmin">Que deseas administrar?</h1>

            <a href="cursos.php" class="botones">Administración de cursos</a>
            <a href="profesores.php" class="botones">Administración de profesores</a>
            

            <h1>Cursos</h1>
            <table>
                <tr>
                    <td class="presenta">ID del curso</td>
                    <td class="presenta">Nombre</td>
                    <td class="presenta">Descripcion</td>
                    <td class="presenta">Horas</td>
                    <td class="presenta">Fecha de inicio</td>
                    <td class="presenta">Fecha de finalizacion</td>
                    <td class="presenta">DNI del profesor</td>
                </tr>

                <?php
                    $sql="SELECT * from cursos";
                    $result=mysqli_query($conexion,$sql);

                    while($mostrar=mysqli_fetch_array($result)){
                ?>

                <tr>
                    <td><?php echo $mostrar['idCurso'] ?></td>
                    <td><?php echo $mostrar['nom'] ?></td>
                    <td><?php echo $mostrar['descripcio'] ?></td>
                    <td><?php echo $mostrar['horas'] ?></td>
                    <td><?php echo $mostrar['data_inici'] ?></td>
                    <td><?php echo $mostrar['data_final'] ?></td>
                    <td><?php echo $mostrar['dni_prof'] ?></td>
                </tr>
                
                <?php
                    }
                ?>
            </table>

            <h1>Profesores</h1>
            <table>
                <tr>
                    <td class="presenta">DNI del profesor</td>
                    <td class="presenta">Nombre</td>
                    <td class="presenta">Apellidos</td>
                    <td class="presenta">Contraseña</td>
                    <td class="presenta">Titulo Academico</td>
                    <td class="presenta">Foto</td>
                    <td class="presenta">Curso que imparte</td>
                </tr>

                <?php
                    $sql="SELECT * from professors";
                    $result=mysqli_query($conexion,$sql);

                    while($mostrar=mysqli_fetch_array($result)){
                ?>

                <tr>
                    <td><?php echo $mostrar['dni_prof'] ?></td>
                    <td><?php echo $mostrar['nom'] ?></td>
                    <td><?php echo $mostrar['cognom'] ?></td>
                    <td><?php echo $mostrar['pass'] ?></td>
                    <td><?php echo $mostrar['titol_academic'] ?></td>
                    <td><img width='150' height='150' src="<?php echo $mostrar['fotografia'] ?> "></td>
                    <td><?php echo $mostrar['cursos_imparteixen'] ?></td>
                </tr>
                
                <?php
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