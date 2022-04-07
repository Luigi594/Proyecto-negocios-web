<?php 

namespace Controllers\Mnt\Catalogos;

use Controllers\PublicController;
use PhpParser\Node\Stmt\Switch_;
use Views\Renderer;

class Catalogo extends PublicController{
    private $_modeStrings = array(
        "INS" => "Agregar al carrito"
    );
    private $_viewData = array(
        "mode" => "INS",
        "idProducto" => 0,
        "nombre" =>"",
        "descripcion" =>"",
        "precio" =>"",
        "modeDsc" =>"",
        "readonly" => false,
        "isInsert" => false,
        "isViewMode" => false,
        "crsxToken"=>""
    );

    private function init(){
        if(isset($_GET["mode"])){
            $this->_viewData["mode"] = $_GET["mode"];
        }
        if(isset($_GET["idProducto"])){
            $this->_viewData["idProducto"] = $_GET["idProducto"];
        }
        if(!isset($this->_modeStrings[$this->_viewData["mode"]])){
            error_log($this->toString()." Modo no valido".$this->_viewData["mode"],0);
            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.catalogos.catalogos', 
            'Sucedio un error al cargar la pagina.'); 
        }
        if($this->_viewData["mode"]!=="INS" && intval($this->_viewData["idProducto"], 10)!==0){
            $this->_viewData["mode"]!=="DSP";
        }
    }

    private function handlePost()
    {
        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);
        if(!isset($_SESSION["producto_crsxToken"]) 
        || $_SESSION["producto_crsxToken"]!== $this->_viewData["crsxToken"])
        {
            unset($_SESSION["producto_crsxToken"]);
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.catologos.catologos', 
                'Ocurrio un error, no se puede procesar el formulario'
            );
        }
        $this->_viewData["idProducto"] = intval($this->_viewData["idProducto"], 10);
        
            unset($_SESSION["producto_crsxToken"]);
            switch ($this->_viewData["mode"]){ 
            case 'INS':
                $result = \Dao\Mnt\Catalogos:: obtenerPorProId(
                    $this->_viewData["nombre"],
                    $this->_viewData["descripcion"],
                    $this->_viewData["precio"],
                    $this->_viewData["idProducto"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.catalogos.catalogos",
                        "Agregando Al catalogo"
                    );
                }
            break;  
            
            }
           
    }

    private function prepareViewData(){
        if($this->_viewData["mode"] == "INS"){

            // si es insertar que no muestre el id
            $this -> viewData["isViewMode"] = true;
            
            $this->_viewData["modeDsc"] = 
                $this->_modeStrings[$this->_viewData["mode"]];
        }else{
            $tmpProducto = \Dao\Mnt\Catalogos::obtenerPorProId(intval($this->_viewData["idProducto"], 10));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpProducto, $this->_viewData);
            $this->_viewData["modeDsc"] = sprintf(
                $this->_modeStrings[$this->_viewData["mode"]],
                $this->_viewData["nombre"],
                $this->_viewData["idProducto"]
            );
        }
       

        $this->_viewData["crsxToken"] = md5(time()."producto");
        $_SESSION["producto_crsxToken"] = $this->_viewData["crsxToken"];
    }

    public function run(): void{
        
        $this->init();
        if($this->isPostBack()){
            $this->handlePost();
        }
        $this-> prepareViewData();
        Renderer::render('mnt/Catalogo', $this->_viewData);
    }
}

?>