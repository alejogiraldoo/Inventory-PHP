<?php
    include "../frontEnd/registro/registro.html";
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
        $sent = false;
        $user = $_POST["user"];
        $pass = $_POST["pass"];

        for ($i=0; $i < count($_SESSION["cuentas"]); $i++) { 
            if($_SESSION["cuentas"][$i]->getUsuario() == $user && $_SESSION["cuentas"][$i]->getContrasena() == $pass) {
                $sent = true;
                if($sent) {
                    if($_SESSION["cuentas"][$i]->getRol() == "2") {
                        echo "usted es admin";
                    } else if($_SESSION["cuentas"][$i]->getRol() == "1") {
                        echo "usted es vendedor";
                    } else {
                        echo "hubo un error en el proceso";
                    }
                } else {
                    echo "la cuenta no existe";
                }
                break;
            }
        }  
    }
?>