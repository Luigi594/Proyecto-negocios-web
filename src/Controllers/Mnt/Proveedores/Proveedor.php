<?php

namespace Controllers\Mnt\Proveedores;

use Controllers\PublicController;
use Views\Renderer;

class Proveedor extends PublicController{

    private $modeString = array(
        "INS" => "Nuevo Proveedor",
        "UPD" => "Editar Proveedor  %s (%s)",
        "DSP" => "Datos del Proveedor %s (%s)",
        "DEL" => "Eliminar Proveedor %s (%s)"
    );

    private $estadoOpciones = array(

        "ACT" => "Activo",
        "INA" => "Inactivo"
    );

    private $viewData = array(

        "mode" => "INS",
        "idProveedor" => 0,
        "nombreProveedor" => "",
        "empresa" => "",
        "direccion" => "",
        "telefono" => 0.00,
        "correo" => "",
        "estado" => "",
        "modeDsc" => "",
        "readonly" => "readonly",
        "isInsert" => false,
        "isViewMode" => false,
        "isRead" => false,
        "estadoOpciones" => []
    );

    private function init(){

        if(isset($_GET["mode"])){
            $this -> viewData["mode"] = $_GET["mode"];
        }

        if(isset($_GET["idProveedor"])){
            $this -> viewData["idProveedor"] = $_GET["idProveedor"];
        }

        if(!isset($this -> modeString[$this -> viewData["mode"]])){

            error_log($this -> toString()."Modo no válido".$this -> viewData["mode"], 0);

            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt.proveedores.proveedor",
                "Error al procesar la página"
            );
        }

        if($this -> viewData["mode"] !== 'INS' && intval($this -> viewData["idProveedor"],10) !== 0){
            $this -> viewData["mode"] !== 'DSP';
        }
    }

    private function handlPost(){

        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this -> viewData);

        $this -> viewData["idProveedor"] = intval($this -> viewData["idProveedor"],10);

        if(!\Utilities\Validators::isMatch($this -> viewData["estado"], "/^(ACT)|(INA)$/")){
            $this -> viewData["errors"][] = "Estado debe ser ACT o INA";
        }

        if(isset($this -> viewData["errors"]) && count($this -> viewData["errors"]) > 0){

        }
        else{

            switch($this -> viewData["mode"]){

                case 'INS':

                    $result = \Dao\Mnt\Proveedores::nuevoProveedor(
                        $this -> viewData["nombreProveedor"],
                        $this -> viewData["empresa"],
                        $this -> viewData["direccion"],
                        $this -> viewData["telefono"],
                        $this -> viewData["correo"],
                        $this -> viewData["estado"]
                    );

                    if($result){
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt.proveedores.proveedor",
                            "Proveedor guardado satisfactoriamente"
                        );
                    }
                    break;

                case 'UPD':

                    $result = \Dao\Mnt\Proveedores::modificarProveedor(
                        $this -> viewData["nombreProveedor"],
                        $this -> viewData["empresa"],
                        $this -> viewData["direccion"],
                        $this -> viewData["telefono"],
                        $this -> viewData["correo"],
                        $this -> viewData["estado"]
                    );

                    if($result){
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt.proveedores.proveedor",
                            "Proveedor actualizado satisfactoriamente"
                        );
                    }
                    break;

                case 'DEL':

                    $result = \Dao\Mnt\Proveedores::eliminarProveedor(
                        $this -> viewData["idProveedor"]
                    );

                    if($result){
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt.proveedores.proveedor",
                            "Proveedor eliminado satisfactoriamente"
                        );
                    }
                    break;
            }
        }
    }

    private function prepareViewData(){

        if($this -> viewData["mode"] == 'INS'){
            
            $this -> viewData["modeDsc"] = $this -> modeString[$this -> viewData["mode"]];
        }
        else{

            $tmpProveedor = \Dao\Mnt\Proveedores::obtenerProveedoresId(
                intval($this -> viewData["idProveedor"],10)
            );

            // si es display, dejar los campos no editables
            if($this -> viewData["mode"] == 'DSP' || $this -> viewData["mode"] == 'DEL'){
                $this -> viewData["isRead"] = true;
            }

            \Utilities\ArrUtils::mergeFullArrayTo($tmpProveedor, $this -> viewData);

            $this -> viewData["modeDsc"] = sprintf(

                $this -> modeString[$this -> viewData["mode"]],
                $this -> viewData["nombre"],
                $this -> viewData["idProveedor"]
            );
        }

        $this -> viewData["estadoOpciones"] =
            
        \Utilities\ArrUtils::toOptionsArray(
            $this -> estadoOpciones,
            'value',
            'text',
            'selected',
            $this -> viewData["estado"]
        );
    }

    public function run(): void
    {
        $this -> init();

        if($this -> isPostBack()){
            $this -> handlPost();
        }

        $this -> prepareViewData();
        Renderer::render("mnt/proveedor", $this -> viewData);
    }
}
?>