<?php 

namespace Controllers\Mnt\Recetas;

use Controllers\PublicController;
use PhpParser\Node\Stmt\Switch_;
use Views\Renderer;

class Receta extends PublicController{
    private $_modeStrings = array(
        "INS" => "Nuevo Receta",
        "UPD" => "Editar %s (%s)",
        "DSP" => "Detalle de %s (%s)",
        "DEL" => "Eliminando %s (%s)"
    );
    private $_estadoOptions = array(
        "ACT" => "Activo",
        "INA" => "Inactivo"
    );
    private $_viewData = array(
        "mode" => "INS",
        "idRecetas" =>0,
        "descripcion" =>"",
        "estado" =>"ACT",
        "modeDsc" =>"",
        "readonly" => false,
        "isInsert" => false,
        "estadoOptions"=>[], 
        "crsxToken"=>""
    );

    private function init(){
        if(isset($_GET["mode"])){
            $this->_viewData["mode"] = $_GET["mode"];
        }
        if(isset($_GET["idRecetas"])){
            $this->_viewData["idRecetas"] = $_GET["idRecetas"];
        }
        if(!isset($this->_modeStrings[$this->_viewData["mode"]])){
            error_log($this->toString()." Modo no valido".$this->_viewData["mode"],0);
            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.recetas.recetas', 
            'Sucedio un error al cargar la pagina.'); 
        }
        if($this->_viewData["mode"]!=="INS" && intval($this->_viewData["idRecetas"], 10)!==0){
            $this->_viewData["mode"]!=="DSP";
        }
    }

    private function handlePost()
    {
        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);
        if(!isset($_SESSION["receta_crsxToken"]) 
        || $_SESSION["receta_crsxToken"]!== $this->_viewData["crsxToken"])
        {
            unset($_SESSION["receta_crsxToken"]);
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.recetas.recetas', 
                'Ocurrio un error, no se puede procesar el formulario'
            );
        }
        $this->_viewData["idRecetas"] = intval($this->_viewData["idRecetas"], 10);
        if(!\Utilities\Validators::isMatch($this->_viewData["estado"], "/^(ACT)|(INA)$/")){
            $this->_viewData["errors"][] = "Receta debe de ser ACT o INA";
        }

        if(isset($this->_viewData["errors"]) && count($this->_viewData["errors"])>0){
            
        }else{
            unset($_SESSION["receta_crsxToken"]);
            switch ($this->_viewData["mode"]){
            case 'INS':
                $result = \Dao\Mnt\Recetas::nuevaReceta(
                    $this->_viewData["descripcion"],
                    $this->_viewData["estado"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt.recetas.recetas',
                        "Receta guardada correctamente"
                    );
                }
            break; 
            case 'UPD':
                $result = \Dao\Mnt\Recetas::actualizarReceta(
                    $this->_viewData["descripcion"],
                    $this->_viewData["estado"],
                    $this->_viewData["idRecetas"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.recetas.recetas",
                        "Receta modificado correctamente"
                    );
                }
            break;  
            case 'DEL':
                $result = \Dao\Mnt\Recetas::eliminarReceta(
                    $this->_viewData["idRecetas"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.recetas.recetas",
                        "Receta eliminada correctamente"
                    );
                }
            break; 
            
            default :

            break;
            }
        }      
    }

    private function prepareViewData(){
        if($this->_viewData["mode"] == "INS"){
            $this->_viewData["modeDsc"] = 
                $this->_modeStrings[$this->_viewData["mode"]];
        }else{
            $tmpReceta = \Dao\Mnt\Recetas::obtenerPorRecId(intval($this->_viewData["idRecetas"], 10));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpReceta, $this->_viewData);
            $this->_viewData["modeDsc"] = sprintf(
                $this->_modeStrings[$this->_viewData["mode"]],
                $this->_viewData["descripcion"],
                $this->_viewData["idRecetas"]
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
        $this->_viewData["crsxToken"] = md5(time()."receta");
        $_SESSION["receta_crsxToken"] = $this->_viewData["crsxToken"];
    }

    public function run(): void{
        
        $this->init();
        if($this->isPostBack()){
            $this->handlePost();
        }
        $this-> prepareViewData();
        Renderer::render('mnt/Receta', $this->_viewData);
    }
}

?>