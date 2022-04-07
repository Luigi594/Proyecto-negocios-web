<?php 

namespace Controllers\Mnt\VentasDetalles;

use Controllers\PublicController;
use Views\Renderer;

class VentasDetalles extends PublicController{
    private $_modeStrings = array(
        "INS" => "Nuevo Detalle",
        "DSP" => "Detalle de %s (%s)",
    );
    private $_viewData = array(
        "mode" => "INS",
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
            $this->_viewData["idDetalle"] = $_GET["idDetalle"];
        }
        if(!isset($this->_modeStrings[$this->_viewData["mode"]])){
            error_log($this->toString()." Modo no valido".$this->_viewData["mode"],0);
            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.ventas_detalles.ventas_detalles', 
            'Sucedio un error al cargar la pagina.'); 
        }
        if($this->_viewData["mode"]!=="INS" && intval($this->_viewData["idDetalle"], 10)!==0){
            $this->_viewData["mode"]!=="DSP";
        }
    }

    private function handlePost()
    {
        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);
        if(!isset($_SESSION["ventas_detalles_crsxToken"]) 
        || $_SESSION["ventas_detalles_crsxToken"]!== $this->_viewData["crsxToken"])
        {
            unset($_SESSION["ventas_detalles_crsxToken"]);
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.ventas_detalles.ventas_detalles', 
                'Ocurrio un error, no se puede procesar el formulario'
            );
        }
        
        unset($_SESSION["ventas_detalles_crsxToken"]);
        switch ($this->_viewData["mode"]){
        case 'INS':
            $result = \Dao\Mnt\VentasDetalles::nuevoDetalle(
                $this->_viewData["idVenta"],
                $this->_viewData["idProducto"],
                $this->_viewData["cantidad"],
                $this->_viewData["precio"],
                $this->_viewData["IVA"],
                $this->_viewData["observacion"],
                $this->_viewData["descuento"]
            );
            if($result){
                \Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt.ventas_detalles.ventas_detalles',
                    "Detalle guardado correctamente"
                );
            }
        break; 

        default :

        break;
        }
             
    }

    private function prepareViewData(){
        if($this->_viewData["mode"] == "INS"){
            $this->_viewData["modeDsc"] = 
                $this->_modeStrings[$this->_viewData["mode"]];
        }else{
            $tmpProducto = \Dao\Mnt\VentasDetalles::obtenerPorId(intval($this->_viewData["idVenta"], 10));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpProducto, $this->_viewData);
            $this->_viewData["modeDsc"] = sprintf(
                $this->_modeStrings[$this->_viewData["mode"]],
                $this->_viewData["idDetalle"],
                $this->_viewData["idVenta"]
            );
        }
        
        $this->_viewData["crsxToken"] = md5(time()."ventas_detalles");
        $_SESSION["ventas_detalles_crsxToken"] = $this->_viewData["crsxToken"];
    }

    public function run(): void{
        
        $this->init();
        if($this->isPostBack()){
            $this->handlePost();
        }
        $this-> prepareViewData();
        Renderer::render('mnt/ventas_detalles', $this->_viewData);
    }
}

?>