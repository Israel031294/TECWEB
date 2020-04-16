<?php

session_start();

if(isset($_SESSION["sesion"])){
    //Checar que tipo de sesion es
    if(isset($_SESSION["sesion"]["tipo"])){
        switch($_SESSION["sesion"]["tipo"]){
            case "Administrador":
                break;

            case "Profesor":
                break;

            default:
                unset($_SESSION["sesion"]);
                header("Location: "."./index.php");
                exit();
                break;
        }
    }else{
        unset($_SESSION["sesion"]);
        header("Location: "."./index.php");
        exit();
    }
}else{
    header("Location: "."./index.php");
    exit();
}