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
                <form action="vender.php" method="get">
                    <div class="mb-3">
                        <label for="exampleInputText1" class="form-label">Codigo</label>
                        <input name="codigo" type="number" class="form-control" id="exampleInputText" aria-describedby="textHelp" value="'.$codigo.'" readonly/>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText1" class="form-label">Nombre del Producto</label>
                        <input name="nombre" type="text" class="form-control" id="exampleText1" required value="'.$_SESSION["productos"][$i]->getNombre().'"/>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText1" class="form-label">Precio</label>
                        <input name="precio" type="number" class="form-control" id="exampleText1" required value="'.$_SESSION["productos"][$i]->getPrecio().'"/>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Cantidad</label>
                        <input name="cantidad" type="number" class="form-control" id="exampleInputPassword1" required/>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Sucursal</label>
                        <input name="sucursal" type="text" class="form-control" id="exampleInputPassword1" required value="'.$_SESSION["productos"][$i]->getSucursal().'"/>
                    </div>
                    <button name="vender" type="submit" class="btn btn-primary">Realizar Venta</button>
                    <br><br>
                </form>
            </main>
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
