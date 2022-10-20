<?php
    include "Producto.php";

    session_start();

    include "check-session.php";

    
    
    include "../frontEnd/inventario/inventario.html";
    if ($_SESSION["rol"] == "2") {
        echo '<li class="nav-item">
        <a class="nav-link active" aria-current="page" href="agregar.php">Agregar Producto</a>
        </li>
        ';
    }
    echo "</ul></div></div></nav></header>";
    echo "<br>";
    echo "<h1>Inventario</h1>";
    echo "<br>";
    
    if (!isset($_SESSION["productos"])){
        $_SESSION["productos"] = array();
    }
    
    if (empty($_SESSION["productos"])){
      echo "<p>No hay productos agregados</p>";
    } else {
        echo "
        <table border='1'>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Sucursal</th>
                <th>Acciones</th>
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
            ";
            if ($_SESSION["rol"] == "2") {
                echo "
                        <b><a href='actualizar.php?codigo=".$_SESSION["productos"][$i]->getCodigo()."&nombre=".$_SESSION["productos"][$i]->getNombre()."&precio=".$_SESSION["productos"][$i]->getPrecio()."&cantidad=".$_SESSION["productos"][$i]->getCantidad()."&sucursal=".$_SESSION["productos"][$i]->getSucursal()."'>Actualizar |</a></b>
                        <b><a href='eliminar.php?codigo=".$_SESSION["productos"][$i]->getCodigo()."'>Eliminar |</a></b>
                ";
            }
            echo "
                        <b><a href='vender.php?codigo=".$_SESSION["productos"][$i]->getCodigo()."&nombre=".$_SESSION["productos"][$i]->getNombre()."&precio=".$_SESSION["productos"][$i]->getPrecio()."&cantidad=".$_SESSION["productos"][$i]->getCantidad()."&sucursal=".$_SESSION["productos"][$i]->getSucursal()."'>Vender</a></b>
                    </td>
                </tr>
            ";
        }
        echo"</table>";
    }
?>