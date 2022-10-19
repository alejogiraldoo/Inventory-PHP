<?php
    include "../frontEnd/vender-producto/vender.html";
    include "Producto.php";

    $codigo = $_GET["codigo"];
    $nombre = $_GET["nombre"];
    $cantidad = $_GET["cantidad"];
    $precio = $_GET["precio"];
    $sucursal = $_GET["sucursal"];

    echo '
        <form action="actualizar.php" method="GET">
            <label for="codigo">Codigo:</label>
            <input name="codigo" id="codigo" type="number" value="'.$codigo.'">
            <br><br>
            <label for="nombre">Nombre:</label>
            <input name="nombre" id="nombre" type="text" value="'.$nombre.'">
            <br><br>
            <label for="cantidad">Cantidad:</label>
            <input name="cantidad" id="cantidad" type="number" value="'.$cantidad.'">
            <br><br>
            <label for="sucursal">Sucursal:</label>
            <input name="sucursal" id="sucursal" type="text" value="'.$sucursal.'">
            <br><br>
            <input name="actualizar" value="Actualizar" type="submit">
        </form>
    ';
?>
