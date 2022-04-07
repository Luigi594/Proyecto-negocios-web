<?php

namespace Controllers\Checkout;

use Controllers\PublicController;

class Checkout extends PublicController{
    public function run():void
    {
        $id = 0;
        $producto="";
        $descripcion = "";
        $idProducto = "";
        $precio = 0;
        $cantidad = 0;
        $viewData = array();
        $tmp=\Dao\Mnt\Carritos::obtenerCarrito(); 

        if (isset($_POST["btnProcesar"])) {
            $PayPalOrder = new \Utilities\Paypal\PayPalOrder(
                "test".(time() - 10000000),
                "http://localhost/Proyecto-negocios-web/index.php?page=checkout_error",
                "http://localhost/Proyecto-negocios-web/index.php?page=checkout_accept"
            );

            foreach($tmp as $item){
               
                $producto = $item["nombre"];
                $descripcion = $item["descripcion"];
                $idProducto = $item["idProducto"];
                $precio = $item["precio"];
                $cantidad = $item["cantidad"];
                $PayPalOrder->addItem($producto, $descripcion, $idProducto, 15, $precio, $cantidad, "DIGITAL_GOODS");
            }
            
            $response = $PayPalOrder->createOrder();
            date_default_timezone_set('America/Honduras');
            $date = date('y-m-d h:i:s');
            \Dao\Mnt\Ventas::nuevaVenta(1, $date,"Tarjeta", "VND", "2022-04-08 00:00:00", "RCB", "Orden procesada");
            foreach($tmp as $item){
                $idProducto = $item["idProducto"];
                $cantidad = $item["cantidad"];
                $precio = $item["precio"];
                \Dao\Mnt\VentasDetalles::nuevoDetalle(1,$idProducto,$cantidad,$precio,0.15,"Ninguna.",0.00);
            }
            \Dao\Mnt\Carritos::eliminarCarrito();
            $_SESSION["orderid"] = $response[1]->result->id;
            \Utilities\Site::redirectTo($response[0]->href);
            die();
        }

        \Views\Renderer::render("paypal/checkout", $viewData);
    }
}
?>
