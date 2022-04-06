<?php
namespace Controllers\Mnt\Carritos;

//use Controllers\PrivateController;
use Controllers\PublicController;
use Views\Renderer;

class Carrito extends PublicController
{
    private $_modeStrings = array(
        "INS" => "Nuevo Carrito",
        "UPD" => "Editar %s (%s)",
        "DSP" => "Detalle de %s (%s)",
        "DEL" => "Eliminando %s (%s)"
    );
    private $_viewData = array(
        "mode"=>"INS",
        "id"=>0,
        "clienteId"=>"",
        "productoId"=>"",
        "cantidad"=>"",
        "precio"=>"",
        "fechahora"=>"",
        "readonly"=>false,
        "isInsert"=>false,
        "crsxToken"=>""
    );
    private function init(){
        if (isset($_GET["mode"])) {
            $this->_viewData["mode"] = $_GET["mode"];
        }
        if (isset($_GET["id"])) {
            $this->_viewData["id"] = $_GET["id"];
        }
        if (!isset($this->_modeStrings[$this->_viewData["mode"]])) {
            error_log(
                $this->toString() . " Mode not valid " . $this->_viewData["mode"],
                0
            );
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.carritos.carritos',
                'Sucedio un error al procesar la página.'
            );
        }
        if ($this->_viewData["mode"] !== "INS" && intval($this->_viewData["id"], 10) !== 0) {
            $this->_viewData["mode"] !== "DSP";
        }
    }
    private function handlePost()
    {
        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);
        print_r($_SESSION);
        print_r($this->_viewData);
        die();
        if (!(isset($_SESSION["carrito_crsxToken"])
            && $_SESSION["carrito_crsxToken"] == $this->_viewData["crsxToken"] )
        ) {
            $_SESSION["carrito_crsxToken"] = "";
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.carritos.carritos',
                'Ocurrio un error, no se puede procesar el formulario.'
            );
        }

            unset($_SESSION["categoria_crsxToken"]);
            switch ($this->_viewData["mode"]) {
            case 'INS':
                # code...
                $result = \Dao\Mnt\Carritos\Carritos::nuevoCarrito(
                    $this->_viewData["clienteId"],
                    $this->_viewData["productoId"],
                    $this->_viewData["cantidad"],
                    $this->_viewData["precio"],
                    $this->_viewData["fechahora"]
                );
                if ($result) {
                    $_SESSION["carrito_crsxToken"] = "";
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt.carritos.carritos',
                        "¡Carrito guardado satisfactoriamente!"
                    );
                }
                break;
            case 'UPD':
                $result = \Dao\Mnt\Carritos\Carritos::actualizarCarrito(
                    $this->_viewData["clienteId"],
                    $this->_viewData["productoId"],
                    $this->_viewData["cantidad"],
                    $this->_viewData["precio"],
                    $this->_viewData["fechahora"]
                );
                if ($result) {
                    $_SESSION["carrito_crsxToken"] = "";
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt.carritos.carritos',
                        "¡Carrito actualizado satisfactoriamente!"
                    );
                }
                break;
            case 'DEL':
                $result = \Dao\Mnt\Carritos\Carritos::eliminarCarrito(
                    $this->_viewData["id"]
                );
                if ($result) {
                    $_SESSION["carrito_crsxToken"] = "";
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt.carritos.carritos',
                        "¡Carrito eliminado satisfactoriamente!"
                    );
                }
                break;
            default:
                # code...
                break;
            }
        
    }
    private function prepareViewData()
    {
        if ($this->_viewData["mode"] == "INS") {
             $this->_viewData["modeDsc"]
                 = $this->_modeStrings[$this->_viewData["mode"]];
        } else {
            $tmpCarrito =\Dao\Mnt\Carritos\Carritos::obtenerPorId(
                intval($this->_viewData["id"], 10)
            );
            \Utilities\ArrUtils::mergeFullArrayTo($tmpCarrito, $this->_viewData);
            $this->_viewData["modeDsc"] = sprintf(
                $this->_modeStrings[$this->_viewData["mode"]],
                $this->_viewData["clienteId"],
                $this->_viewData["productoId"],
                $this->_viewData["id"]
            );
        }

        $this->_viewData["crsxToken"] = md5(time()."carrito");
        $_SESSION["carrito_crsxToken"] = $this->_viewData["crsxToken"];
    }
    public function run(): void
    {
        $this->init();
        if ($this->isPostBack()) {
            $this->handlePost();
        }
        $this->prepareViewData();
        Renderer::render('mnt/carritos', $this->_viewData);
    }
}
