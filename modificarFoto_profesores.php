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

            require 'header.php';
            include "funciones.php";
            ?>

            <h1 id="tituloadmin">Editor de foto</h1>
            <a href="admin.php" class="botones">Volver a administrador</a>

            <?php
            if (isset($_FILES['fotografia'])){
                //Trato los datos que me han enviado en el formuario
                $dni_prof = $_GET['dni_prof'];
                $conn = conectDB();
                if(is_uploaded_file ($_FILES['fotografia']['tmp_name'])) {
                    $filename = $_FILES['fotografia']['name'];
                    $destination = 'img/'.$filename;
                    $file = $_FILES['fotografia']['tmp_name'];
                    if (move_uploaded_file($file, $destination)) {
                        $query = "UPDATE professors SET fotografia = '$destination' WHERE dni_prof LIKE '$dni_prof'";
                        mysqli_query($conn,$query);
                        echo '<meta http-equiv="refresh" content="0;url=profesores.php" />';
                    } 
                    else {
            
                        echo "<p class=fallo>Hubo un fallo al subir el archivo.</p>";
                        echo '<meta http-equiv="refresh" content="2;url=profesores.php" />';
                
                    }
                }

            }else{
                $conn = conectDB();
                $dni_prof = $_GET['dni_prof'];
                $sql = "SELECT * FROM professors WHERE dni_prof = '$dni_prof'";
                $result = mysqli_query($conn,$sql);

                while($mostrar=mysqli_fetch_array($result)){
            ?>

            <form action="modificarFoto_profesores.php?dni_prof=<?php echo $dni_prof; ?>" method="post" enctype="multipart/form-data" >
                <input type="file" name="fotografia"  class="seleccionar" required>
                <input type="submit" value="Send">
            </form>
            Foto anterior UwU: <img src="<?php echo $mostrar['fotografia']; ?>" width='150px' height='150px'></img>

            <?php
                }
            } 
                ?>
            </table>

    

</body>
</html>