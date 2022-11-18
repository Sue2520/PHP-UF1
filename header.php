<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>

    <a href="administrador.php">Inicio como administrador</a>
    <a href="salir.php">Salir</a>

    <?php
        if(isset($_SESSION['tipo']) && $_SESSION['tipo']== "A"){
            
            echo $_SESSION['nombre'];
            echo 'Alumno';

        }else if(isset($_SESSION['tipo']) && $_SESSION['tipo']== "B"){

            echo $_SESSION['nombre'];
            echo 'Profesor';

        }else{

        }    

    ?>
</header>