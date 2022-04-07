<?php

namespace Controllers\Checkout;

use Controllers\PublicController;

class Checkout extends PublicController{
    public function run():void
    {
        $clienteId=0;
        $productoId=0;
        $cantidad=0;
        $precio=0;
        $fechahora="";
        $viewData = array();
        $tmp=\Dao\Mnt\Carritos::obtenerTodos(); 

        if (isset($_POST["btnProcesar"])) {
            $PayPalOrder = new \Utilities\Paypal\PayPalOrder(
                "test".(time() - 10000000),
                "http://localhost/Proyecto-negocios-web/index.php?page=checkout_error",
                "http://localhost/Proyecto-negocios-web/index.php?page=checkout_accept"
            );

            foreach($tmp as $item){
                $clienteId=$item["clienteId"];
                $productoId=$item["productoId"];
                $cantidad=$item["cantidad"];
                $precio=$item["precio"];
                $fechahora=$item["fechahora"];
                $PayPalOrder->addItem($clienteId, $productoId, $cantidad, $precio, 15,$fechahora,"DIGITAL_GOODS");
            }
 
            $response = $PayPalOrder->createOrder();
            $_SESSION["orderid"] = $response[1]->result->id;
            \Utilities\Site::redirectTo($response[0]->href);
            die();
        }

        \Views\Renderer::render("paypal/checkout", $viewData);
    }
}
?>
