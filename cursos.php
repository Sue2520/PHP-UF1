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
    <title>Cursos</title>
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

            <h1 id="tituloadmin">Administrador de cursos</h1>
            <a href="crear_curso.php" class="botones">Añadir cursos</a>
            <a href="admin.php" class="botones">Volver a administrador</a>

            <table>
                <tr>
                    <td class="presenta">ID del curso</td>
                    <td class="presenta">Nombre</td>
                    <td class="presenta">Descripcion</td>
                    <td class="presenta">Horas</td>
                    <td class="presenta">Fecha de inicio</td>
                    <td class="presenta">Fecha de finalizacion</td>
                    <td class="presenta">DNI del profesor</td>
                    <td class="presenta">Modificar</td>
                    <td class="presenta">Act/Des</td>
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

                    <td><a href="modificar_cursos.php?idCurso=<?php echo $mostrar['idCurso'] ?>"><i class="fa fa-pencil"></i></a></td>
                    <td>
                        <a href="borrar_curso.php?idCurso=<?php echo $mostrar['idCurso'];?>&activo=<?php echo $mostrar['act']?>">
                            <?php
                            if ($mostrar['act'] == 1){
                                echo " <img class='imgoff' width='70' height='70' src='img/switch-off.png'>";

                            }
                            else{
                                echo " <img class='imgoff' width='70' height='70' src='img/switch-on.png'>";

                            }
                            ?>
                        
                        </a>
                    </td>
                
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