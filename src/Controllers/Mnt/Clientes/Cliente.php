<?php

namespace Controllers\Mnt\Clientes;

use Controllers\PublicController;
use Views\Renderer;

class Cliente extends PublicController{

    private $modeString = array(
        "INS" => "Nuevo Cliente",
        "UPD" => "Editar cliente  %s (%s)",
        "DSP" => "Datos del cliente %s (%s)",
        "DEL" => "Eliminar cliente %s (%s)"
    );

    private $estadoOpciones = array(

        "AC" => "Activo",
        "INA" => "Inactivo"
    );

    private $viewData = array(

        "mode" => "INS",
        "idCliente" => 0,
        "nombre" => "",
        "apellido" => "",
        "telefono" => 0.00,
        "rtn" => "",
        "fechaNacimiento" => "",
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

        if(isset($_GET["idCliente"])){
            $this -> viewData["idCliente"] = $_GET["idCliente"];
        }

        if(!isset($this -> modeString[$this -> viewData["mode"]])){

            error_log($this -> toString()."Modo no válido".$this -> viewData["mode"], 0);

            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt.clientes.clientes",
                "Error al procesar la página"
            );
        }

        if($this -> viewData["mode"] !== 'INS' && intval($this -> viewData["idCliente"],10) !== 0){
            $this -> viewData["mode"] !== 'DSP';
        }
    }

    private function handlPost(){

        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this -> viewData);

        $this -> viewData["idCliente"] = intval($this -> viewData["idCliente"],10);

        if(!\Utilities\Validators::isMatch($this -> viewData["estado"], "/^(AC)|(INA)$/")){
            $this -> viewData["errors"][] = "Estado debe ser AC o INA";
        }

        if(isset($this -> viewData["errors"]) && count($this -> viewData["errors"]) > 0){

        }
        else{

            switch($this -> viewData["mode"]){

                case 'INS':

                    $result = \Dao\Mnt\Clientes::nuevoCliente(
                        $this -> viewData["nombre"],
                        $this -> viewData["apellido"],
                        $this -> viewData["telefono"],
                        $this -> viewData["rtn"],
                        $this -> viewData["fechaNacimiento"],
                        $this -> viewData["estado"]
                    );

                    if($result){
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt.clientes.clientes",
                            "Cliente guardado satisfactoriamente"
                        );
                    }
                    break;

                case 'UPD':

                    $result = \Dao\Mnt\Clientes::modificarCliente(
                        $this -> viewData["nombre"],
                        $this -> viewData["apellido"],
                        $this -> viewData["telefono"],
                        $this -> viewData["rtn"],
                        $this -> viewData["fechaNacimiento"],
                        $this -> viewData["estado"],
                        $this -> viewData["idCliente"]
                    );

                    if($result){
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt.clientes.clientes",
                            "Cliente actualizado satisfactoriamente"
                        );
                    }
                    break;

                case 'DEL':

                    $result = \Dao\Mnt\Clientes::eliminarCliente(
                        $this -> viewData["idCliente"]
                    );

                    if($result){
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt.clientes.clientes",
                            "Cliente eliminado satisfactoriamente"
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

            $tmpCliente = \Dao\Mnt\Clientes::obtenerClientesId(
                intval($this -> viewData["idCliente"],10)
            );

            // si es display, dejar los campos no editables
            if($this -> viewData["mode"] == 'DSP' || $this -> viewData["mode"] == 'DEL'){
                $this -> viewData["isRead"] = true;
            }

            \Utilities\ArrUtils::mergeFullArrayTo($tmpCliente, $this -> viewData);

            $this -> viewData["modeDsc"] = sprintf(

                $this -> modeString[$this -> viewData["mode"]],
                $this -> viewData["nombre"],
                $this -> viewData["idCliente"]
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
        Renderer::render("mnt/cliente", $this -> viewData);
    }
}
?>