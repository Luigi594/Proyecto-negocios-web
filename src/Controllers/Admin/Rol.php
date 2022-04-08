<?php 

namespace Controllers\Admin;

class Rol extends \Controllers\PrivateController
{
    public function __construct()
    {
        /*
        $userInRole = \Utilities\Security::isInRol(
            \Utilities\Security::getUserId(),
            "ADMINISTRADOR"
        );
        */
        
        parent::__construct();
    }
    
    private $RolId = "";
    private $RolDsc = "";
    private $RolEst = "";
    private $RolEst_ACT = "";
    private $RolEst_INA = "";

    private $mode_dsc = "";
    private $mode_adsc = array(
        "INS" => "Nuevo Rol",
        "UPD" => "Editar Código: %s Descripción: %s",
        "DEL" => "Eliminar Código: %s Descripción: %s",
        "DSP" => "Visualizar Código: %s Descripción: %s"
    );

    private $notDisplayIns = false;
    private $readonly = "";
    private $showaction= true;

    private $hasErrors = false;
    private $aErrors = array();

    public function run() :void
    {

        $this->mode = isset($_GET["mode"])?$_GET["mode"]:"";
        $this->RolId = isset($_GET["RolId"])?$_GET["RolId"]:"";

        if (!$this->isPostBack()) 
        {
            if ($this->mode !== "INS") 
            {
                $this->_load();
            } 
            else 
            {
                $this->mode_dsc = $this->mode_adsc[$this->mode];
            }
        } 
        else 
        {
            $this->_loadPostData();
            if (!$this->hasErrors) 
            {
                switch ($this->mode)
                {
                    case "INS":
                        if (\Dao\Mnt\Roles::insert($this->RolDsc)) {
                            \Utilities\Site::redirectToWithMsg(
                                "index.php?page=admin_roles",
                                "¡Rol Agregado Satisfactoriamente!"
                            );
                        }
                    break;

                    case "UPD":
                        if (\Dao\Mnt\Roles::update($this->RolDsc, $this->RolEst, $this->RolId)) {
                            \Utilities\Site::redirectToWithMsg(
                                "index.php?page=admin_roles",
                                "¡Rol Actualizado Satisfactoriamente!"
                            );
                        }
                    break;

                    case "DEL":
                        if (\Dao\Mnt\Roles::delete($this->RolId)) {
                            \Utilities\Site::redirectToWithMsg(
                                "index.php?page=admin_roles",
                                "¡Rol Eliminado Satisfactoriamente!"
                            );
                        }
                    break;
                }
            }
        }

        $dataview = get_object_vars($this);
        \Views\Renderer::render("admin/rol", $dataview);
    }

    private function _load()
    {
        $_data = \Dao\Mnt\Roles::getOne($this->RolId);
        if ($_data) 
        {
            $this->RolId = $_data["RolId"];
            $this->RolDsc = $_data["RolDsc"];
            $this->RolEst = $_data["RolEst"];
            $this->_setViewData();
        }
    }

    private function _loadPostData()
    {
        $this->RolId = isset($_POST["RolId"]) ? $_POST["RolId"] : "" ;
        $this->RolDsc = isset($_POST["RolDsc"]) ? $_POST["RolDsc"] : "" ;
        $this->RolEst = isset($_POST["RolEst"]) ? $_POST["RolEst"] : "" ;

        //validaciones
        //aplicar todas la reglas de negocio

        if (\Utilities\Validators::IsEmpty($this->RolDsc)) 
        {
            $this->aErrors[] = "La descripción del rol no puede ir vacía.";
        }

        if($this->mode=="INS")
        {
            if(!empty(\Dao\Mnt\Roles::getOne(strtoupper($this->RolDsc))))
            {
                $this->aErrors[] = "El rol ya se encuentra ingresado";
            }
        }

        $this->hasErrors = (count($this->aErrors) > 0);
        $this->_setViewData();
    }

    private function _setViewData()
    {
        $this->RolEst_ACT = ($this->RolEst === "ACT") ? "selected" : "";
        $this->RolEst_INA = ($this->RolEst === "INA") ? "selected" : "";
        $this->mode_dsc = sprintf(
            $this->mode_adsc[$this->mode],
            $this->RolId,
            $this->RolDsc
        );

        $this->notDisplayIns = ($this->mode=="INS") ? false : true;
        $this->readonly = ($this->mode =="DEL" || $this->mode=="DSP") ? "readonly":"";
        $this->showaction = !($this->mode == "DSP");
    }
}

?>