<?php
    include "../frontEnd/registro/registro.html";/* 
    echo "".include '../frontEnd/registro/registro.css'.""; */
    include "Trabajador.php";

    session_start();

    
    if (!isset($_SESSION["cuentas"])){
        $_SESSION["cuentas"] = array();
    }

    if(isset($_POST["registrar"])) {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $rol = "0";

        if($user == "admin") {
            $rol = "2";
        } else if($user == "vendedor") {
            $rol = "1";
        }

        array_push($_SESSION["cuentas"], new Trabajador($id, $nombre, $user, $pass, $rol));
        echo "<br> Cuenta creada con exito";
    }
    
    if(isset($_POST["iniciar-sesion"])) {
        $sentUser = false;
        $sentPass = false;
        $_SESSION["user"] = $_POST["user"];
        $pass = $_POST["pass"];

        for ($i=0; $i < count($_SESSION["cuentas"]); $i++) { 
            if($_SESSION["cuentas"][$i]->getUsuario() == $_SESSION["user"]) {
                $sentUser = true;
                if ($_SESSION["cuentas"][$i]->getContrasena() == $pass){
                    $sentPass = true;
                    $_SESSION["rol"] = $_SESSION["cuentas"][$i]->getRol();
                    break;
                }
            }
        }

        if($sentUser) {
            if ($sentPass){
                header("Location: inventario.php");
            }else{
                echo "El usuario o la contraseña son INCORRECTOS";
            }
        } else {
            echo "la cuenta no existe";
        }
    }
?>