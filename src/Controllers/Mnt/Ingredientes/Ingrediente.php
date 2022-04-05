<?php 
namespace Controllers\Mnt\Ingredientes;

use Controllers\PublicController;
use PhpParser\Node\Stmt\Switch_;
use Views\Renderer;

class Ingrediente extends PublicController{
    private $_modeStrings = array(
        "INS" => "Nuevo Ingrediente",
        "UPD" => "Editar %s (%s)",
        "DSP" => "Detalle de %s (%s)",
        "DEL" => "Eliminando %s (%s)"
    );
    private $_estadoOptions = array(
        "ACT" => "Activo",
        "INA" => "Inactivo"
    );
    private $_proveedoresOptions = array(
        "1" => "Jetstereo",
        "2" => "Intur",
        "3" => "Diprova",
        "4" => "La Colonia",
        "5" => "Walmart",
        "6" => "NutriBoom",
        "7" => "Despensa Familiar"
    );
    private $_viewData = array(
        "mode" => "INS",
        "idIngrediente" => 0,
        "idProveedor" =>0,
        "proveedoresOptions"=>[],
        "nombre" =>"",
        "descripcion" =>"",
        "precio" =>"",
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
        if(isset($_GET["idIngrediente"])){
            $this->_viewData["idIngrediente"] = $_GET["idIngrediente"];
        }
        if(!isset($this->_modeStrings[$this->_viewData["mode"]])){
            error_log($this->toString()." Modo no valido".$this->_viewData["mode"],0);
            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.ingredientes.ingredientes', 
            'Sucedio un error al cargar la pagina.'); 
        }
        if($this->_viewData["mode"]!=="INS" && intval($this->_viewData["idIngrediente"], 10)!==0){
            $this->_viewData["mode"]!=="DSP";
        }
    }

    private function handlePost()
    {
        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);
        if(!isset($_SESSION["ingrediente_crsxToken"]) 
        || $_SESSION["ingrediente_crsxToken"]!== $this->_viewData["crsxToken"])
        {
            unset($_SESSION["ingrediente_crsxToken"]);
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.ingredientes.ingredientes', 
                'Ocurrio un error, no se puede procesar el formulario'
            );
        }
        $this->_viewData["idIngrediente"] = intval($this->_viewData["idIngrediente"], 10);
        if(!\Utilities\Validators::isMatch($this->_viewData["estado"], "/^(ACT)|(INA)$/")){
            $this->_viewData["errors"][] = "Ingrediente debe de ser ACT o INA";
        }

        if(isset($this->_viewData["errors"]) && count($this->_viewData["errors"])>0){
            
        }else{
            unset($_SESSION["ingrediente_crsxToken"]);
            switch ($this->_viewData["mode"]){
            case 'INS':
                $result = \Dao\Mnt\Ingredientes::nuevoIngrediente(
                    $this->_viewData["idProveedor"],
                    $this->_viewData["nombre"],
                    $this->_viewData["descripcion"],
                    $this->_viewData["precio"],
                    $this->_viewData["estado"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt.ingredientes.ingredientes',
                        "Ingrediente guardado correctamente"
                    );
                }
            break; 
            case 'UPD':
                $result = \Dao\Mnt\Ingredientes::actualizarIngrediente(
                    $this->_viewData["idProveedor"],
                    $this->_viewData["nombre"],
                    $this->_viewData["descripcion"],
                    $this->_viewData["precio"],
                    $this->_viewData["estado"],
                    $this->_viewData["idIngrediente"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.ingredientes.ingredientes",
                        "Ingrediente modificado correctamente"
                    );
                }
            break;  
            case 'DEL':
                $result = \Dao\Mnt\Ingredientes::eliminarIngrediente(
                    $this->_viewData["idIngrediente"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.ingredientes.ingredientes",
                        "Ingrediente eliminado correctamente"
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
            $tmpIngrediente = \Dao\Mnt\ingredientes::obtenerPorIngreId(intval($this->_viewData["idIngrediente"], 10));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpIngrediente, $this->_viewData);
            $this->_viewData["modeDsc"] = sprintf(
                $this->_modeStrings[$this->_viewData["mode"]],
                $this->_viewData["nombre"],
                $this->_viewData["idIngrediente"]
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
        $this->_viewData["proveedoresOptions"] = 
        \Utilities\ArrUtils::toOptionsArray(
            $this->_proveedoresOptions,
            'value',
            'text',
            'select',
            $this->_viewData['idProveedores']
        );

        $this->_viewData["crsxToken"] = md5(time()."ingrediente");
        $_SESSION["ingrediente_crsxToken"] = $this->_viewData["crsxToken"];
    }

    public function run(): void{
        
        $this->init();
        if($this->isPostBack()){
            $this->handlePost();
        }
        $this-> prepareViewData();
        Renderer::render('mnt/Ingrediente', $this->_viewData);
    }
}
?>