<?php
    include "../frontEnd/inventario/inventario.html";
    include "Producto.php";
    session_start();

    if (!isset($_SESSION["productos"])){
        $_SESSION["productos"] = array();
    }
    
    if (empty($_SESSION["productos"])){
      echo "No hay productos agregados";
    }else{
        echo "
        <table border='1'>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Sucursal</th>
                <th>TAREAS</th>
            </tr>
        ";
        for ($i=0; $i < count($_SESSION["productos"]); $i++) { 
            echo"
                <tr>
                    <td>".$_SESSION["productos"][$i]->getCodigo()."</td>
                    <td>".$_SESSION["productos"][$i]->getNombre()."</td>
                    <td>".$_SESSION["productos"][$i]->getPrecio()."</td>
                    <td>".$_SESSION["productos"][$i]->getCantidad()."</td>
                    <td>".$_SESSION["productos"][$i]->getSucursal()."</td>
                    <td>
                        <a href='actualizar.php?codigo=".$_SESSION["productos"][$i]->getCodigo()."&nombre=".$_SESSION["productos"][$i]->getNombre()."&precio=".$_SESSION["productos"][$i]->getPrecio()."&cantidad=".$_SESSION["productos"][$i]->getCantidad()."&sucursal=".$_SESSION["productos"][$i]->getSucursal()."'>Actualizar |</a>
                        <a href='eliminar.php?codigo=".$_SESSION["productos"][$i]->getCodigo()."'>Eliminar</a>
                        <a href='vender.php?codigo=".$_SESSION["productos"][$i]->getCodigo()."&nombre=".$_SESSION["productos"][$i]->getNombre()."&precio=".$_SESSION["productos"][$i]->getPrecio()."&cantidad=".$_SESSION["productos"][$i]->getCantidad()."&sucursal=".$_SESSION["productos"][$i]->getSucursal()."'>Vender</a>
                    </td>
                </tr>
            ";
        }
        echo"</table>";
    }
?>