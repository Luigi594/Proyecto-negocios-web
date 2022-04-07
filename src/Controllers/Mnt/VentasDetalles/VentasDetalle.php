<?php 

namespace Controllers\Mnt\VentasDetalles;

use Controllers\PublicController;
use Views\Renderer;

class VentasDetalle extends PublicController{
    private $_modeStrings = array(
        "DSP" => "Detalle",
    );
    private $_viewData = array(
        "mode" => "DSP", 
        "idDetalle" => 0,
        "idVenta" =>0,
        "idProducto" =>0,
        "cantidad" =>"",
        "precio" =>"",
        "IVA" =>"",
        "observacion" =>"",
        "descuento" =>"",
        "modeDsc" =>"",
        "readonly" => false,
        "isInsert" => false,
        "crsxToken"=>""
    );

    private function init(){
        if(isset($_GET["mode"])){
            $this->_viewData["mode"] = $_GET["mode"];
        }
        if(isset($_GET["idDetalle"])){
            $this->_viewData["idVenta"] = $_GET["idVenta"];
        }
        if(!isset($this->_modeStrings[$this->_viewData["mode"]])){
            error_log($this->toString()." Modo no valido".$this->_viewData["mode"],0);
            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.ventas_detalles.ventas_detalles', 
            'Sucedio un error al cargar la pagina.'); 
        }
        if($this->_viewData["mode"]!=="INS" && intval($this->_viewData["idVenta"], 10)!==0){
            $this->_viewData["mode"]!=="DSP";
        }
    }

    private function prepareViewData(){
        
        $tmpProducto = \Dao\Mnt\VentasDetalles::obtenerPorId(intval($this->_viewData["idVenta"], 10));
        \Utilities\ArrUtils::mergeFullArrayTo($tmpProducto, $this->_viewData);
        $this->_viewData["modeDsc"] = sprintf(
            $this->_modeStrings[$this->_viewData["mode"]]                
        );
        
        
        $this->_viewData["crsxToken"] = md5(time()."ventas_detalles");
        $_SESSION["ventas_detalles_crsxToken"] = $this->_viewData["crsxToken"];
    }

    public function run(): void{
        
        $this->init();
        $this-> prepareViewData();
        Renderer::render('mnt/ventas_detalles', $this->_viewData);
    }
}

?>