<?php
    include "../frontEnd/agregar-producto/agregar.html";
    include "Producto.php";

    session_start();

    include "check-session.php";
    
    if(isset($_POST["agregar"])) {
        $codigo = $_POST["codigo"];
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $cantidad = $_POST["cantidad"];
        $sucursal = $_POST["sucursal"];

        array_push($_SESSION["productos"], new Producto($codigo, $nombre, $precio, $cantidad, $sucursal));

        echo "<script>
        window.alert('Producto agregado exitosamente. ');
        </script>;";
    }
?>