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
                $idProducto = $item["idPrducto"];
                $precio = $item["precio"];
                $cantidad = $item["cantidad"];
                $PayPalOrder->addItem($producto, $descripcion, $idProducto, 15, $precio, $cantidad, "DIGITAL_GOODS");
            }
 
            $response = $PayPalOrder->createOrder();
            $_SESSION["orderid"] = $response[1]->result->id;
            \Utilities\Site::redirectTo($response[0]->href);
            
            \Dao\Mnt\Ventas::nuevaVenta(2, "Tarjeta", "VND", "2022-05-20 00:00:00", "PND", "Orden procesada");
            die();
        }

        \Views\Renderer::render("paypal/checkout", $viewData);
    }
}
?>
