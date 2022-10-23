<?php
    include "../frontEnd/vender-producto/vender.html";
    
    include "Producto.php";
    include "Trabajador.php";
    
    session_start();
    include "check-session.php";
    
    if($_SESSION["rol"] == "2" || $_SESSION["rol"] == "1") {
        echo '
        <title>Vender</title>
        </head>
        <body>
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="inventario.php">Volver a Inventario</a>
                </div>
            </nav>
            <h1>Vender Producto</h1>
            <main>
        </body>
        </html>
        ';
    } else {
        echo '
        <title>Comprar</title>
        </head>
        <body>
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="inventario.php">Volver a Inventario</a>
                </div>
            </nav>
            <h1>Comprar Producto</h1>
            <main>
        </body>
        </html>
        ';
    }
    
    $codigo = $_GET["codigo"];
    if($_SESSION["rol"] != 0) {
        echo '
        <form action="vender.php" method="get">
        <h2>Información del Cliente</h2>
        <div class="mb-3">
        <label for="exampleInputText1" class="form-label">Identificación del Cliente</label>
        <input name="ced_cliente" type="number" class="form-control" id="exampleInputText" aria-describedby="textHelp"/>
        </div>
        <div class="mb-3">
        <label for="exampleInputText1" class="form-label">Nombre del Cliente</label>
        <input name="nom_cliente" type="text" class="form-control" id="exampleText1" required/>
            </div>
            <div class="mb-3">
            <label for="exampleInputText1" class="form-label">N° de Telefono del Cliente</label>
            <input name="tel_cliente" type="number" class="form-control" id="exampleText1" required/>
            </div>
            <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Dirección del Cliente</label>
            <input name="dir_cliente" type="text" class="form-control" id="exampleInputPassword1" required/>
            </div>
            <br>
            ';
        }
        
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
                        <input name="nombre" type="text" class="form-control" id="exampleText1" required value="'.$_SESSION["productos"][$i]->getNombre().'" readonly/>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText1" class="form-label">Precio</label>
                        <input name="precio" type="number" class="form-control" id="exampleText1" required value="'.$_SESSION["productos"][$i]->getPrecio().'" readonly/>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Cantidad</label>
                        <input name="cantidad" type="number" class="form-control" id="exampleInputPassword1" min="1" required />
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Sucursal</label>
                        <input name="sucursal" type="text" class="form-control" id="exampleInputPassword1" required value="'.$_SESSION["productos"][$i]->getSucursal().'"/>
                    </div>
                    <input name="vender" type="submit" class="btn btn-primary" value="Realizar Venta">
                    <br><br>
                </form>
            </main>
            '; 
            break;
        }
    }
    
    if (isset($_GET["vender"])){
        if($_SESSION["rol"] == 0) {
            for ($i=0; $i < count($_SESSION["cuentas"]); $i++) {
                if($_SESSION["cuentas"][$i]->getUsuario() == $_SESSION["user"]) {
                    $ced_cliente = $_SESSION["cuentas"][$i]->getId();
                    $nom_cliente = $_SESSION["cuentas"][$i]->getNombre();
                    $tel_cliente = $_SESSION["cuentas"][$i]->getTelefono();
                    $dir_cliente = $_SESSION["cuentas"][$i]->getDireccion();
                    $cantidad = $_GET["cantidad"];
                    break;
                }
            }
        } else {
            $sent = false;
            $codigo = $_GET["codigo"];
            $ced_cliente = $_GET["ced_cliente"];
            $nom_cliente = $_GET["nom_cliente"];
            $tel_cliente = $_GET["tel_cliente"];
            $dir_cliente = $_GET["dir_cliente"];
            $cantidad = $_GET["cantidad"];
        }   

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
            echo "
            <script>
                window.alert('La venta se realizó con exito.');
            </script>
            ";
        } else {
            echo "
            <script>
                window.alert('Hubo un error al realizar la venta.');
                window.history.back();
            </script>
            ";
        } 
    }
?>