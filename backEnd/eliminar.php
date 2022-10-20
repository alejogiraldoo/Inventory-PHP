<?php
    include "Producto.php";
    session_start();

    include "check-session.php";
    
    $codigo = $_GET["codigo"];
    for ($i=0; $i < count($_SESSION["productos"]); $i++) { 
        if($_SESSION["productos"][$i]->getCodigo() == $codigo) {
            unset($_SESSION["productos"][$i]);
            $_SESSION["productos"] = array_values($_SESSION["productos"]);
            header("Location: inventario.php");
        }
    }
?>