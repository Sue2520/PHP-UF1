<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
      require 'header.php';
      include "funciones.php";
      if(isset($_POST['password'])) {

        login($_POST['nombre'],$_POST['password']);
      }
      else {?>
    <h1>Administrar</h1>
    <span><a href="login.php" class="botones">Login</a></span>
    <span>o <a href="Registrarse.php" class="botones">Registrarse</a></span>
    <form action="administrador.php" method="post">
        <input type="text" name="nombre" placeholder="Nombre">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="submit" value="Send">
    </form>
        <?php } ?>

  

</body>
</html>