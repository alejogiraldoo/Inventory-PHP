<?php
    include "../frontEnd/actualizar-producto/actualizar.html";
    include "Producto.php";
    session_start();

    include "check-session.php";

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
            echo "<script>
            window.alert('Los datos han sido actualizados exitosamente. ');
            </script>";
        } else {
            echo "<script>
            window.alert('Hubo un error en los datos a actualizar. ');
            </script>";
        }

    }

    $codigo = $_GET["codigo"];
    $nombre = $_GET["nombre"];
    $cantidad = $_GET["cantidad"];
    $precio = $_GET["precio"];
    $sucursal = $_GET["sucursal"];
    
    echo '
        <main>
            <form action="actualizar.php" method="get">
                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">Codigo</label>
                    <input name="codigo" type="number" class="form-control" id="exampleInputText" aria-describedby="textHelp" value="'.$codigo.'" readonly/>
                </div>
                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">Nombre del Producto</label>
                    <input name="nombre" type="text" class="form-control" id="exampleText1" required value="'.$nombre.'"/>
                </div>
                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">Precio</label>
                    <input name="precio" type="number" class="form-control" id="exampleText1" required value="'.$precio.'"/>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Cantidad</label>
                    <input name="cantidad" type="number" class="form-control" id="exampleInputPassword1" required value="'.$cantidad.'" min="1"/>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Sucursal</label>
                    <input name="sucursal" type="text" class="form-control" id="exampleInputPassword1" required value="'.$sucursal.'"/>
                </div>
                <button name="actualizar" type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </main>
    ';
?>