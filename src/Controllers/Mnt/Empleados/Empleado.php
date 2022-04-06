<?php

namespace Controllers\Mnt\Empleados;

use Controllers\PublicController;
use Views\Renderer;

class Empleado extends PublicController{

    private $modeString = array(
        "INS" => "Nuevo Empleado",
        "UPD" => "Editar Empleado  %s (%s)",
        "DSP" => "Datos del Empleado %s (%s)",
        "DEL" => "Eliminar Empleado %s (%s)"
    );

    private $estadoOpciones = array(

        "AC" => "Activo",
        "INA" => "Inactivo"
    );

    private $viewData = array(

        "mode" => "INS",
        "idEmpleado" => 0,
        "puestoID" => 0,
        "nombre" => "",
        "apellido" => "",
        "telefono" => 0.00,
        "fechaNacimiento" => "",
        "estado" => "",
        "modeDsc" => "",
        "readonly" => "readonly",
        "isInsert" => false,
        "isViewMode" => false,
        "isRead" => false,
        "estadoOpciones" => []
    );

    private $_empleadoIdOptions = array(
        "1" => "Gerente",
        "2" => "Sub Gerente",
        "3" => "Cajero",
        "4" => "Jefe de Cocina",
        "5" => "Cocinero"
    );

    private function init(){

        if(isset($_GET["mode"])){
            $this -> viewData["mode"] = $_GET["mode"];
        }

        if(isset($_GET["idEmpleado"])){
            $this -> viewData["idEmpleado"] = $_GET["idEmpleado"];
        }

        if(!isset($this -> modeString[$this -> viewData["mode"]])){

            error_log($this -> toString()."Modo no válido".$this -> viewData["mode"], 0);

            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt.Empleados.Empleados",
                "Error al procesar la página"
            );
        }

        if($this -> viewData["mode"] !== 'INS' && intval($this -> viewData["idEmpleado"],10) !== 0){
            $this -> viewData["mode"] !== 'DSP';
        }
    }

    private function handlPost(){

        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this -> viewData);

        $this -> viewData["idEmpleado"] = intval($this -> viewData["idEmpleado"],10);

        if(!\Utilities\Validators::isMatch($this -> viewData["estado"], "/^(AC)|(INA)$/")){
            $this -> viewData["errors"][] = "Estado debe ser AC o INA";
        }

        if(isset($this -> viewData["errors"]) && count($this -> viewData["errors"]) > 0){

        }
        else{

            switch($this -> viewData["mode"]){

                case 'INS':

                    $result = \Dao\Mnt\Empleados::nuevoEmpleado(
                        $this -> viewData["nombre"],
                        $this -> viewData["apellido"],
                        $this -> viewData["puestoId"],
                        $this -> viewData["telefono"],
                        $this -> viewData["fechaNacimiento"],
                        $this -> viewData["estado"]
                    );

                    if($result){
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt.Empleados.Empleados",
                            "Empleado guardado satisfactoriamente"
                        );
                    }
                    break;

                case 'UPD':

                    $result = \Dao\Mnt\Empleados::modificarEmpleado(
                        $this -> viewData["nombre"],
                        $this -> viewData["apellido"],
                        $this -> viewData["empleadoId"],
                        $this -> viewData["telefono"],
                        $this -> viewData["fechaNacimiento"],
                        $this -> viewData["estado"],
                    );

                    if($result){
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt.Empleados.Empleados",
                            "Empleado actualizado satisfactoriamente"
                        );
                    }
                    break;

                case 'DEL':

                    $result = \Dao\Mnt\Empleados::eliminarEmpleado(
                        $this -> viewData["idEmpleado"]
                    );

                    if($result){
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt.Empleados.Empleados",
                            "Empleado eliminado satisfactoriamente"
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

            $tmpEmpleado = \Dao\Mnt\Empleados::obtenerEmpleadosId(
                intval($this -> viewData["idEmpleado"],10)
            );

            // si es display, dejar los campos no editables
            if($this -> viewData["mode"] == 'DSP' || $this -> viewData["mode"] == 'DEL'){
                $this -> viewData["isRead"] = true;
            }

            \Utilities\ArrUtils::mergeFullArrayTo($tmpEmpleado, $this -> viewData);

            $this -> viewData["modeDsc"] = sprintf(

                $this -> modeString[$this -> viewData["mode"]],
                $this -> viewData["nombre"],
                $this -> viewData["idEmpleado"]
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
        Renderer::render("mnt/Empleado", $this -> viewData);
    }
}
?>