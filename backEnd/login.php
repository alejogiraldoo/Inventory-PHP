<?php
    include "../frontEnd/login/login.html";
    include "Trabajador.php";

    session_start();

    if(!isset($_SESSION["cuentas"])){
        $_SESSION["cuentas"] = array();
    }

    if(isset($_POST["iniciar-sesion"])) {
        $sentUser = false;
        $_SESSION["user"] = $_POST["user"];
        $pass = $_POST["pass"];

        for ($i=0; $i < count($_SESSION["cuentas"]); $i++) { 
            if($_SESSION["cuentas"][$i]->getUsuario() == $_SESSION["user"] && $_SESSION["cuentas"][$i]->getContrasena() == $pass) {
                $sentUser = true;
                $_SESSION["rol"] = $_SESSION["cuentas"][$i]->getRol();
                break;
            }
        }

        if ($sentUser){
            header("Location: inventario.php");
        }else{
            echo "  
            <script>            
                window.alert('El usuario o contraseña son INCORRECTOS. ');
                window.history.back();
            </script>;
            ";
        }
    }
?>