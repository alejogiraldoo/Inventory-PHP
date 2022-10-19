<?php
    include "Producto.php";
    include "../frontEnd/agregar-producto/agregar.html";

    session_start();
    if(isset($_POST["agregar"])) {
        $codigo = $_POST["codigo"];
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $cantidad = $_POST["cantidad"];
        $sucursal = $_POST["sucursal"];

        array_push($_SESSION["productos"], new Producto($codigo, $nombre, $precio, $cantidad, $sucursal));
    }
?>