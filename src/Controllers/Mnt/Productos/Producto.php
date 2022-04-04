<?php 

namespace Controllers\Mnt\Productos;

use Controllers\PublicController;
use PhpParser\Node\Stmt\Switch_;
use Views\Renderer;

class Producto extends PublicController{
    private $_modeStrings = array(
        "INS" => "Nuevo Producto",
        "UPD" => "Editar %s (%s)",
        "DSP" => "Detalle de %s (%s)",
        "DEL" => "Eliminando %s (%s)"
    );
    private $_estadoOptions = array(
        "ACT" => "Activo",
        "INA" => "Inactivo"
    );
    private $_recetasOptions = array(
        "1" => "Whopper",
        "2" => "whopper JR",
        "3" => "Sor Burger",
        "4" => "Santa Madre",
        "5" => "A la Padre",
        "6" => "Jalapeña Sor",
        "7" => "Pancho Raf",
        "8" => "Papas el Sor",
        "9" => "Refresco Te la sor",
        "10" => "El sorPresa Burgero"
    );
    private $_viewData = array(
        "mode" => "INS",
        "idProducto" => 0,
        "idReceta" =>0,
        "recetasOptions"=>[],
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
        if(isset($_GET["idProducto"])){
            $this->_viewData["idProducto"] = $_GET["idProducto"];
        }
        if(!isset($this->_modeStrings[$this->_viewData["mode"]])){
            error_log($this->toString()." Modo no valido".$this->_viewData["mode"],0);
            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.productos.productos', 
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
                'index.php?page=mnt.productos.productos', 
                'Ocurrio un error, no se puede procesar el formulario'
            );
        }
        $this->_viewData["idProducto"] = intval($this->_viewData["idProducto"], 10);
        if(!\Utilities\Validators::isMatch($this->_viewData["estado"], "/^(ACT)|(INA)$/")){
            $this->_viewData["errors"][] = "Producto debe de ser ACT o INA";
        }

        if(isset($this->_viewData["errors"]) && count($this->_viewData["errors"])>0){
            
        }else{
            unset($_SESSION["producto_crsxToken"]);
            switch ($this->_viewData["mode"]){
            case 'INS':
                $result = \Dao\Mnt\Productos::nuevoProducto(
                    $this->_viewData["idReceta"],
                    $this->_viewData["nombre"],
                    $this->_viewData["descripcion"],
                    $this->_viewData["precio"],
                    $this->_viewData["estado"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt.productos.productos',
                        "producto guardado correctamente"
                    );
                }
            break; 
            case 'UPD':
                $result = \Dao\Mnt\Productos::actualizarProducto(
                    $this->_viewData["idReceta"],
                    $this->_viewData["nombre"],
                    $this->_viewData["descripcion"],
                    $this->_viewData["precio"],
                    $this->_viewData["estado"],
                    $this->_viewData["idProducto"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.productos.productos",
                        "Producto modificado correctamente"
                    );
                }
            break;  
            case 'DEL':
                $result = \Dao\Mnt\Productos::eliminarProducto(
                    $this->_viewData["idProducto"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.productos.productos",
                        "Producto eliminado correctamente"
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
            $tmpProducto = \Dao\Mnt\Productos::obtenerPorProId(intval($this->_viewData["idProducto"], 10));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpProducto, $this->_viewData);
            $this->_viewData["modeDsc"] = sprintf(
                $this->_modeStrings[$this->_viewData["mode"]],
                $this->_viewData["nombre"],
                $this->_viewData["idProducto"]
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
        $this->_viewData["recetasOptions"] = 
        \Utilities\ArrUtils::toOptionsArray(
            $this->_recetasOptions,
            'value',
            'text',
            'select',
            $this->_viewData['idReceta']
        );

        $this->_viewData["crsxToken"] = md5(time()."producto");
        $_SESSION["producto_crsxToken"] = $this->_viewData["crsxToken"];
    }

    public function run(): void{
        
        $this->init();
        if($this->isPostBack()){
            $this->handlePost();
        }
        $this-> prepareViewData();
        Renderer::render('mnt/Producto', $this->_viewData);
    }
}

?>