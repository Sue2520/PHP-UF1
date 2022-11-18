<?php
    session_start();
    require "funciones.php";
    if(!isset($_SESSION['rol'])) {
        echo "No estás autorizado a ver esta página.";
        echo "<meta http-equiv='refresh' content='2;url=administrador.php' />";
    }
    else {
        if(validarAdmin($_SESSION['rol'])) {

            session_start();
            $conn = conectDB();

            /* Debes pasar también el estado del curso actual y el update debe ghacer lo contrauiot*/
            $estadoActual = $_REQUEST['activo'];
            $idCurso = $_REQUEST['idCurso'];
            if ($estadoActual == 1){
                $nuevoEstado = 0;
            }
            else{
                $nuevoEstado = 1;
            }

            $sql = "UPDATE cursos SET act = $nuevoEstado WHERE idCurso = $idCurso";
            mysqli_query($conn,$sql);
            echo "<meta http-equiv='refresh' content='0;url=cursos.php' />";
        }
        else {
            echo "No estás autorizado a ver esta página";
            echo "<meta http-equiv='refresh' content='2;url=administrador.php' />";
        }

    }
?>