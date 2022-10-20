<?php
    include "../frontEnd/actualizar-producto/actualizar.html";
    include "Producto.php";
    session_start();

    if (isset($_GET["actualizar"])){
        $sent = false; 
        $codigo = $_GET["codigo"];
        $nombre = $_GET["nombre"];
        $cantidad = $_GET["cantidad"];
        $precio = $_GET["precio"];
        $sucursal = $_GET["sucursal"];
        
        for ($i=0; $i < count($_SESSION["productos"]); $i++) { 
            if($_SESSION["productos"][$i]->getCodigo() == $codigo) {
                $sent = true;
                $_SESSION["productos"][$i]->setCodigo($codigo);
                $_SESSION["productos"][$i]->setNombre($nombre);
                $_SESSION["productos"][$i]->setPrecio($precio);
                $_SESSION["productos"][$i]->setCantidad($cantidad);
                $_SESSION["productos"][$i]->setSucursal($sucursal);
                break;
            }
        }

        if($sent) {
            echo "Los datos han sido actualizados.<br><br>";
        } else {
            echo "Hubo un error en los datos actualizados.<br><br>";
        }

    }

    $codigo = $_GET["codigo"];
    $nombre = $_GET["nombre"];
    $cantidad = $_GET["cantidad"];
    $precio = $_GET["precio"];
    $sucursal = $_GET["sucursal"];
    echo '
        <form action="actualizar.php" method="GET">
            <label for="codigo">Codigo:</label>
            <input name="codigo" id="codigo" type="number" value="'.$codigo.'" readonly>
            <br><br>
            <label for="nombre">Nombre:</label>
            <input name="nombre" id="nombre" type="text" value="'.$nombre.'">
            <br><br>
            <label for="precio">Precio:</label>
            <input name="precio" id="precio" type="number" value="'.$precio.'">
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