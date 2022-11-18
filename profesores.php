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
    <title>profesores</title>
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

    <h1 id="tituloadmin">Administrador de profesores</h1>
    <a href="crear_profesor.php" class="botones">añadir profesor</a>
    <a href="admin.php" class="botones">Volver a administrador</a>

    <table>
        <tr>
            <td class="presenta">DNI del profesor</td>
            <td class="presenta">Nombre</td>
            <td class="presenta">Apellidos</td>
            <td class="presenta">Contraseña</td>
            <td class="presenta">Titulo Academico</td>
            <td class="presenta">Foto</td>
            <td class="presenta">Curso que imparte</td>
            <td class="presenta">Modificar</td>
            <td class="presenta">Modificar foto</td>
            <td class="presenta">Act/Des</td>
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
            <!-- <td><a href="modificar_profesores.php"><i class="fa fa-pencil"></i></a></td> -->
            <td><a href="modificar_profesores.php?dni_prof=<?php echo $mostrar['dni_prof'] ?>"><i class="fa fa-pencil"></i></a></td>
            <td><a href="modificarFoto_profesores.php?dni_prof=<?php echo $mostrar['dni_prof'] ?>"><i class="fa fa-pencil"></i></a></td>
            <td>
                <a href="desact_professor.php?dni_prof=<?php echo $mostrar['dni_prof'];?>&activo=<?php echo $mostrar['act']?>">
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