<?php
namespace Controllers\Mnt\Ventas;

//use Controllers\PrivateController;
use Controllers\PublicController;
use Views\Renderer;

class Ventas extends PublicController
{
    private $_modeStrings = array(
        "INS" => "Nueva Venta",
        "DSP" => "Detalle de %s (%s)",
    );
    private $_estadoVentaOptions = array(
        "VND" => "Vendido",
        "PND" => "Pendiente",
        "CNL" => "Cancelado"
    );
    private $_estadoEntregaOptions = array(
        "RCB" => "Recibido",
        "PND" => "Pendiente",
        "CNL" => "Cancelado"
    );
    private $_viewData = array(
        "mode"=>"INS",
        "idVenta"=>0,
        "clienteId"=>0,
        "fechaVenta"=>"",
        "tipoPago"=>"",
        "estadoVenta"=>NULL,
        "fechaEntrega"=>NULL,
        "estadoEntrega"=>NULL,
        "docsMeta"=>NULL,
        "modeDsc"=>"",
        "readonly"=>false,
        "isInsert"=>false,
        "estadoVentaOptions"=>[],
        "estadoEntregaOptions" => [],
        "crsxToken"=>""
    );
    private function init(){
        if (isset($_GET["mode"])) {
            $this->_viewData["mode"] = $_GET["mode"];
        }
        if (isset($_GET["idVenta"])) {
            $this->_viewData["idVenta"] = $_GET["idVenta"];
        }
        if (!isset($this->_modeStrings[$this->_viewData["mode"]])) {
            error_log(
                $this->toString() . " Mode not valid " . $this->_viewData["mode"],
                0
            );
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.ventas.ventas',
                'Sucedio un error al procesar la página.'
            );
        }
        if ($this->_viewData["mode"] !== "INS" && intval($this->_viewData["idVenta"], 10) !== 0) {
            $this->_viewData["mode"] !== "DSP";
        }
    }
    private function handlePost()
    {
        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);
        print_r($_SESSION);
        print_r($this->_viewData);
        die();
        if (!(isset($_SESSION["ventas_crsxToken"])
            && $_SESSION["ventas_crsxToken"] == $this->_viewData["crsxToken"] )
        ) {
            $_SESSION["ventas_crsxToken"] = "";
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.ventas.ventas',
                'Ocurrio un error, no se puede procesar el formulario.'
            );
        }


        $this->_viewData["idVenta"] = intval($this->_viewData["idVenta"], 10);
        if (!\Utilities\Validators::isMatch(
            $this->_viewData["estadoVenta"],
            "/^(VND)|(PND)|(CNL)$/"
        )
        ) {
            $this->_viewData["errors"][] = "Estado de una Venta debe ser VND, PND o CNL";
        }

        if (isset($this->_viewData["errors"]) && count($this->_viewData["errors"]) > 0 ) {

        } else {
            unset($_SESSION["ventas_crsxToken"]);
            switch ($this->_viewData["mode"]) {
            case 'INS':
                # code...
                $result = \Dao\Mnt\Ventas::nuevaVenta(
                    $this->_viewData["clienteId"],
                    $this->_viewData["fechaVenta"],
                    $this->_viewData["tipoPago"],
                    $this->_viewData["estadoVenta"],
                    $this->_viewData["fechaEntrega"],
                    $this->_viewData["estadoEntrega"],
                    $this->_viewData["docsMeta"],
                );
                if ($result) {
                    $_SESSION["ventas_crsxToken"] = "";
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt.ventas.ventas',
                        "¡Venta guardada satisfactoriamente!"
                    );
                }
                break;
            default:
                # code...
                break;
            }
        }
    }
    private function prepareViewData()
    {
        if ($this->_viewData["mode"] == "INS") {
             $this->_viewData["modeDsc"]
                 = $this->_modeStrings[$this->_viewData["mode"]];
        } else {
            $tmpVentas =\Dao\Mnt\Ventas::obtenerPorId(
                intval($this->_viewData["clienteId"], 10)
            );
            \Utilities\ArrUtils::mergeFullArrayTo($tmpVentas, $this->_viewData);
            $this->_viewData["modeDsc"] = sprintf(
                $this->_modeStrings[$this->_viewData["mode"]],
                $this->_viewData["clienteId"],
                $this->_viewData["idVenta"]
            );
        }
        $this->_viewData["_estadoVentaOptions"]
            = \Utilities\ArrUtils::toOptionsArray(
                $this->_estadoVentaOptions,
                'value',
                'text',
                'selected',
                $this->_viewData['estadoVenta']
            );
        $this->_viewData["_estadoEntregaOptions"]
            = \Utilities\ArrUtils::toOptionsArray(
                $this->_estadoEntregaOptions,
                'value',
                'text',
                'selected',
                $this->_viewData['estadoEntrega']
            );

        $this->_viewData["crsxToken"] = md5(time()."carrito");
        $_SESSION["ventas_crsxToken"] = $this->_viewData["crsxToken"];
    }
    public function run(): void
    {
        $this->init();
        if ($this->isPostBack()) {
            $this->handlePost();
        }
        $this->prepareViewData();
        Renderer::render('mnt/ventas', $this->_viewData);
    }
}
