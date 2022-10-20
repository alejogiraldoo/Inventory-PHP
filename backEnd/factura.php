<?php
    include "../frontEnd/factura/factura.html";
    include "Producto.php";
    session_start();

    $codigo = $_GET["codigo"];
    $cantidad = $_GET["cantidad"];
    $ced_cliente = $_GET["ced_cliente"];
    $nom_cliente = $_GET["nom_cliente"];
    $tel_cliente = $_GET["tel_cliente"];
    $dir_cliente = $_GET["dir_cliente"];

    echo "<h2>Datos del Cliente</h2>";
    echo "Identificación del Cliente: ".$ced_cliente;
    echo "<br><br>";
    echo "Nombre del Cliente: ".$nom_cliente;
    echo "<br><br>";
    echo "N° de Telefono del Cliente: ".$tel_cliente;
    echo "<br><br>";
    echo "Dirección del Cliente: ".$dir_cliente;
    echo "<br><br>";
            
    for ($i=0; $i < count($_SESSION["productos"]); $i++) { 
        if($_SESSION["productos"][$i]->getCodigo() == $codigo) {
            
            echo "<h2>Datos de la Compra</h2>";
            echo "
                <table border='1'>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Sucursal</th>
                        <th>Total</th>
                    </tr>
                ";
            echo"
                <tr>
                    <td>".$_SESSION["productos"][$i]->getCodigo()."</td>
                    <td>".$_SESSION["productos"][$i]->getNombre()."</td>
                    <td>".$_SESSION["productos"][$i]->getPrecio()."</td>
                    <td>".$cantidad."</td>
                    <td>".$_SESSION["productos"][$i]->getSucursal()."</td>
                    <td>".$_SESSION["productos"][$i]->getPrecio() * $cantidad."</td>
                </tr>
            ";
            echo"</table>";
            break;
        }
    }
?>