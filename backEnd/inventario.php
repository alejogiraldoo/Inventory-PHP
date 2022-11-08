<?php
/* error_reporting(0); */
include "Producto.php";

session_start();

/* unset($_SESSION["productos"]);
    session_destroy(); */

include "check-session.php";

include "../frontEnd/inventario/inventario.html";
if ($_SESSION["rol"] == "2") {
    echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="agregar.php">Agregar Producto</a></li>
        ';
}

echo "</ul></div></div></nav></header>";
echo "<br>";
if ($_SESSION["rol"] == "2" || $_SESSION["rol"] == 1) {
    echo "<h1>Inventario</h1>";
} else {
    echo "<h1>Productos Disponibles</h1>";
}
echo "<br>";

if (!isset($_SESSION["productos"])) {
    $_SESSION["productos"] = array();
}

if (empty($_SESSION["productos"])) {
    echo "<p>No hay productos agregados en ninguna sucursal</p>";
} else {
    if ($_SESSION["rol"] != "0") {
        MostrarProductosSucursal("La Naranja");
        MostrarProductosSucursal("El Mango");
        MostrarProductosSucursal("La Mora");
        MostrarProductosSucursal("El Guineo");
        MostrarProductosSucursal("La Auyama");
        MostrarProductosSucursal("El Banano");
    } else {
        /* $newCantidad = 0;    
            for ($i=0; $i < count($_SESSION["productos"]) - 1; $i++) {
                for($j=$i+1; $j < count($_SESSION["productos"]); $j++) {

                }
            }
            echo $newCantidad; */

        $array = array();
        for ($j = 0; $j < count($_SESSION["productos"]); $j++) {
            $codigo = $_SESSION["productos"][$j]->getCodigo();
            $producto = $_SESSION["productos"][$j]->getNombre();
            $precio = $_SESSION["productos"][$j]->getPrecio();
            $cantidad = $_SESSION["productos"][$j]->getCantidad();

            if (array_key_exists($producto, $array)) {
                $array[$producto]["cantidad"] += $cantidad;
            } else {
                $array[$producto]["codigo"] = $codigo;
                $array[$producto]["precio"] = $precio;
                $array[$producto]["cantidad"] = $cantidad;
            }
        }

        /*  echo "FIN DE CREACIÓN DEL ARRAY";
            print_r($array); */
        echo "
            <table border='1'>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            ";
        foreach ($array as $key => $value) {
            /* echo $key." ".$value["precio"]; */
            echo "
                    <tr>
                        <td>" . $value["codigo"] . "</td>
                        <td>" . $key . "</td>
                        <td>" . $value["precio"] . "</td>
                        <td>" . $value["cantidad"] . "</td>
                        <td>
                ";
            /* for ($i = 0; $i < count($array); $i++) { */
               
                if ($_SESSION["rol"] == "2") {
                    echo "
                            <b><a href='actualizar.php?codigo=" . $value["codigo"] . "&nombre=" . $key . "&precio=" . $value["precio"] . "&cantidad=" . $value["cantidad"] . "'>Actualizar |</a></b>
                            <b><a href='eliminar.php?codigo=" . $value["codigo"] . "'>Eliminar |</a></b>
                    ";
                }

                if ($_SESSION["rol"] == 2 || $_SESSION["rol"] == 1) {
                    echo "<b><a href='vender.php?codigo=" . $value["codigo"] . "&nombre=" . $key . "&precio=" . $value["precio"] . "&cantidad=" . $value["cantidad"] ."'>Vender</a></b>";
                } else {
                    echo "<b><a href='vender.php?codigo=" . $value["codigo"] . "&nombre=" . $key . "&precio=" . $value["precio"] . "&cantidad=" . $cantidad ."'>Comprar</a></b>";
                }

                echo "   
                        </td>
                    </tr>
                ";
                /*  } */
            }
            echo "</table><br>";
    }
}

function MostrarProductosSucursal($sucursal)
{
    $sentSucu = false;
    echo "<h3>" . $sucursal . "</h3>";
    for ($i = 0; $i < count($_SESSION["productos"]); $i++) {
        if ($_SESSION["productos"][$i]->getSucursal() == $sucursal) {
            $sentSucu = true;
            echo "
                <table border='1'>
                <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                ";
            echo "
                    <tr>
                        <td>" . $_SESSION["productos"][$i]->getCodigo() . "</td>
                        <td>" . $_SESSION["productos"][$i]->getNombre() . "</td>
                        <td>" . $_SESSION["productos"][$i]->getPrecio() . "</td>
                        <td>" . $_SESSION["productos"][$i]->getCantidad() . "</td>
                        <td>
                ";
            if ($_SESSION["rol"] == "2") {
                echo "
                            <b><a href='actualizar.php?codigo=" . $_SESSION["productos"][$i]->getCodigo() . "&nombre=" . $_SESSION["productos"][$i]->getNombre() . "&precio=" . $_SESSION["productos"][$i]->getPrecio() . "&cantidad=" . $_SESSION["productos"][$i]->getCantidad() . "&sucursal=" . $_SESSION["productos"][$i]->getSucursal() . "'>Actualizar |</a></b>
                            <b><a href='eliminar.php?codigo=" . $_SESSION["productos"][$i]->getCodigo() . "'>Eliminar |</a></b>
                    ";
            }

            if ($_SESSION["rol"] == 2 || $_SESSION["rol"] == 1) {
                echo "<b><a href='vender.php?codigo=" . $_SESSION["productos"][$i]->getCodigo() . "&nombre=" . $_SESSION["productos"][$i]->getNombre() . "&precio=" . $_SESSION["productos"][$i]->getPrecio() . "&cantidad=" . $_SESSION["productos"][$i]->getCantidad() . "&sucursal=" . $_SESSION["productos"][$i]->getSucursal() . "'>Vender</a></b>";
            } else {
                echo "<b><a href='vender.php?codigo=" . $_SESSION["productos"][$i]->getCodigo() . "&nombre=" . $_SESSION["productos"][$i]->getNombre() . "&precio=" . $_SESSION["productos"][$i]->getPrecio() . "&cantidad=" . $_SESSION["productos"][$i]->getCantidad() . "&sucursal=" . $_SESSION["productos"][$i]->getSucursal() . "'>Comprar</a></b>";
            }

            echo "   
                        </td>
                    </tr>
                ";
            echo "</table><br>";
        }
    }
    if ($sentSucu == false) {
        echo "<p>No hay productos agregados a esta sucursal.</p><br>";
    }
}
