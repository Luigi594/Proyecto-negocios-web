<?php 

namespace Controllers\Mnt\Puestos;

use Controllers\PublicController;
use PhpParser\Node\Stmt\Switch_;
use Views\Renderer;

class Puesto extends PublicController{
    private $_modeStrings = array(
        "INS" => "Nuevo Puesto",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Eliminando %s (%s)"
    );
    private $_viewData = array(
        "mode" => "INS",
        "idPuesto" =>0,
        "descripcion" =>"",
        "modeDsc" =>"",
        "readonly" => false,
        "isInsert" => false,
        "crsxToken"=>""
    );

    private function init(){
        if(isset($_GET["mode"])){
            $this->_viewData["mode"] = $_GET["mode"];
        }
        if(isset($_GET["idPuesto"])){
            $this->_viewData["idPuesto"] = $_GET["idPuesto"];
        }
        if(!isset($this->_modeStrings[$this->_viewData["mode"]])){
            error_log($this->toString()." Modo no valido".$this->_viewData["mode"],0);
            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.puestos.puestos', 
            'Sucedio un error al cargar la pagina.'); 
        }
        if($this->_viewData["mode"]!=="INS" && intval($this->_viewData["idPuestos"], 10)!==0){
            $this->_viewData["mode"]!=="DSP";
        }
    }

    private function handlePost()
    {
        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);
        if(!isset($_SESSION["puesto_crsxToken"]) 
        || $_SESSION["puesto_crsxToken"]!== $this->_viewData["crsxToken"])
        {
            unset($_SESSION["puesto_crsxToken"]);
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.puestos.puestos', 
                'Ocurrio un error, no se puede procesar el formulario'
            );
        }
        $this->_viewData["idPuesto"] = intval($this->_viewData["idPuesto"], 10);

        
            unset($_SESSION["puesto_crsxToken"]);
            switch ($this->_viewData["mode"]){
            case 'INS':
                $result = \Dao\Mnt\Puestos::nuevoPuesto(
                    $this->_viewData["descripcion"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt.puestos.puestos',
                        "Puesto guardado correctamente"
                    );
                }
            break; 
            case 'UPD':
                $result = \Dao\Mnt\Puestos::actualizarPuesto(
                    $this->_viewData["descripcion"],
                    $this->_viewData["idPuesto"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.recetas.recetas",
                        "Puesto modificado correctamente"
                    );
                }
            break;  
            case 'DEL':
                $result = \Dao\Mnt\Puestos::eliminarPuesto(
                    $this->_viewData["idPuesto"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.recetas.recetas",
                        "Puesto eliminado correctamente"
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
            $tmpReceta = \Dao\Mnt\Puestos::obtenerPorPtsId(intval($this->_viewData["idPuesto"], 10));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpReceta, $this->_viewData);
            $this->_viewData["modeDsc"] = sprintf(
                $this->_modeStrings[$this->_viewData["mode"]],
                $this->_viewData["descripcion"],
                $this->_viewData["idPuesto"]
            );
        }

        $this->_viewData["estadoOptions"] = 
        \Utilities\ArrUtils::toOptionsArray(
            $this->_estadoOptions,
            'value',
            'text',
            'select',
            $this->_viewData['estado']
        );
        $this->_viewData["crsxToken"] = md5(time()."puestos");
        $_SESSION["receta_crsxToken"] = $this->_viewData["crsxToken"];
    }

    public function run(): void{
        
        $this->init();
        if($this->isPostBack()){
            $this->handlePost();
        }
        $this-> prepareViewData();
        Renderer::render('mnt/Puesto', $this->_viewData);
    }
}

?>