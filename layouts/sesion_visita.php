<?php

start_session();

if(isset($_SESSION["sesion"])){
    //Checar que tipo de sesion es
    if(isset($_SESSION["sesion"]["tipo"])){
        switch($_SESSION["sesion"]["tipo"]){
            case "Admon":
                header("Location: "."./inicio.php");
                break;

            case "Profesor":
                header("Location: "."./inicio.php");
                break;

            default:
                unset($_SESSION["sesion"]);
                header("Location: "."./index.php");
                break;
        }
    }else{
        unset($_SESSION["sesion"]);
        //header("Location: "."./index.php");
    }
}else{
    //header("Location: "."./index.php");
}


?>

