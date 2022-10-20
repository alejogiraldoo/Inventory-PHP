<?php
    include "../frontEnd/vender-producto/vender.html";
    include "Producto.php";
    session_start();

    include "check-session.php";

    $codigo = $_GET["codigo"];
    
    for ($i=0; $i < count($_SESSION["productos"]); $i++) { 
        if($_SESSION["productos"][$i]->getCodigo() == $codigo) {
            echo '
            <h2>Informacion del Producto</h2>
            <label for="codigo">Codigo:</label>
            <input name="codigo" id="codigo" type="number" value="'.$codigo.'" readonly>
            <br><br>
            <label for="nombre">Nombre:</label>
            <input name="nombre" id="nombre" type="text" value="'.$_SESSION["productos"][$i]->getNombre().'" readonly>
            <br><br>
            <label for="precio">Precio:</label>
            <input name="precio" id="precio" type="number" value="'.$_SESSION["productos"][$i]->getPrecio().'" readonly>
            <br><br>
            <label for="cantidad">Cantidad:</label>
            <input name="cantidad" id="cantidad" type="number" min="1" required>
            <br><br>
            <label for="sucursal">Sucursal:</label>
            <input name="sucursal" id="sucursal" type="text" value="'.$_SESSION["productos"][$i]->getSucursal().'" readonly>
            <br><br>
            <input name="vender" type="submit" value="Vender">
            <br><br>
            </form>
            '; 
            break;
        }
    }
    
    if (isset($_GET["vender"])){
        $sent = false;
        $codigo = $_GET["codigo"];
        $ced_cliente = $_GET["ced_cliente"];
        $nom_cliente = $_GET["nom_cliente"];
        $tel_cliente = $_GET["tel_cliente"];
        $dir_cliente = $_GET["dir_cliente"];
        $cantidad = $_GET["cantidad"];
        
        for ($i=0; $i < count($_SESSION["productos"]); $i++) { 
            if($_SESSION["productos"][$i]->getCodigo() == $codigo) {
                $sent = true;
                if($_SESSION["productos"][$i]->getCantidad() < $cantidad) {
                    echo "La cantidad de productos a vender es mayor a la del inventario.";
                    $sent = false;
                } else {
                    $total = $_SESSION["productos"][$i]->getCantidad() - $cantidad;
                    $_SESSION["productos"][$i]->setCantidad($total);
                    echo "¿Desea generar una factura? <br>";
                    echo "<a href='factura.php?codigo=".$codigo."&cantidad=".$cantidad."&ced_cliente=".$ced_cliente."&nom_cliente=".$nom_cliente."&tel_cliente=".$tel_cliente."&dir_cliente=".$dir_cliente."'>Generar Factura</a>";
                    break;
                }  
            }
        } 

        if($sent) {
            echo "<br> La venta se realizó con exito. <br><br>";
        } else {
            echo "<br> Hubo un error en la venta. <br><br>";
        } 
    }
?>
