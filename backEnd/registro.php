<?php
    include "../frontEnd/registro/registro.html";/* 
    echo "".include '../frontEnd/registro/registro.css'.""; */
    include "Trabajador.php";

    session_start();

    
    if (!isset($_SESSION["cuentas"])){
        $_SESSION["cuentas"] = array();
    }

    if(isset($_POST["registrar"])) {
        $id = $_POST["cedula"];
        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $direccion = $_POST["direccion"];
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $rol = "0";

        if($user == "admin") {
            $rol = "2";
        } else if($user == "vendedor") {
            $rol = "1";
        } else if($user != "admin" || $user != "vendedor"){
            $rol = "0";
        }

        array_push($_SESSION["cuentas"], new Trabajador($id, $nombre, $telefono, $direccion, $user, $pass, $rol));
        echo "
            <script>
                window.alert('Cuenta creada con exito.');
            </script>
        ";
    } 
?>