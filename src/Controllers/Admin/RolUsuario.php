<?php 

namespace Controllers\Admin;

class RolUsuario extends \Controllers\PrivateController
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

    private $UsuarioId = 0;
    private $UsuarioId2 = "";
    private $RolId = "";
    private $RolId2 = "";
    private $RolUsuarioEst = "";
    private $RolUsuarioExp = "";
    private $RolUsuarioFch = "";
    private $UsuarioNombre = "";
    private $UsuarioEmail = "";
    private $UsuarioTipo = "";
    private $RolUsuarioEst_ACT = "";
    private $RolUsuarioEst_INA = "";

    private $mode = "";
    private $mode_dsc = "";
    private $mode_adsc = array(
        "INS" => "Agregar Rol a Usuario",
        "UPD" => "Editar Usuario: %s Rol: %s",
        "DEL" => "Eliminar Usuario: %s Rol: %s",
        "DSP" => "Visualizar Usuario: %s Rol: %s"
    );

    private $minimumDate = "";

    private $onlyDisplayIns = true;
    private $notDisplayIns = false;
    private $allInfoDisplayed = false;
    private $disabled = "";
    private $readonly = "";
    private $showaction= true;

    private $hasErrors = false;
    private $aErrors = array();

    private $usuarios = array();
    private $roles = array();
    
    public function run() :void
    {
        $this->usuarios = \Dao\Mnt\RolesUsuarios::getUsuarios();
        $this->roles = \Dao\Mnt\RolesUsuarios::getRoles();

        $this->minimumDate = date('Y-m-d', time() + 31104000);  //(12*30*24*60*60) (m d h mi s));
        $this->mode = isset($_GET["mode"])?$_GET["mode"]:"";
        $this->UsuarioId = isset($_GET["UsuarioId"])?$_GET["UsuarioId"]:"";
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
                        if (\Dao\Mnt\RolesUsuarios::insert($this->UsuarioId2, $this->RolId2)) 
                        {
                            \Utilities\Site::redirectToWithMsg(
                                "index.php?page=admin_rolesusuarios",
                                "¡Rol Agregado a Usuario Satisfactoriamente!"
                            );
                        }
                    break;

                    case "UPD":
                        if (\Dao\Mnt\RolesUsuarios::update($this->UsuarioId, $this->RolId, $this->RolUsuarioEst, $this->RolUsuarioExp)) 
                        {
                            \Utilities\Site::redirectToWithMsg(
                                "index.php?page=admin_rolesusuarios",
                                "¡Rol Actualizado al Usuario Satisfactoriamente!"
                            );
                        }
                    break;

                    case "DEL":
                        if (\DAO\Mnt\RolesUsuarios::delete($this->UsuarioId, $this->RolId)) 
                        {
                            \Utilities\Site::redirectToWithMsg(
                                "index.php?page=admin_rolesusuarios",
                                "¡Rol Eliminado al Usuario Satisfactoriamente!"
                            );
                        }
                    break;
                }
            }
        }

        $dataview = get_object_vars($this);
        \Views\Renderer::render("admin/rolusuario", $dataview);
    }

    private function _load()
    {
        $_data = \Dao\Mnt\RolesUsuarios::getOne($this->UsuarioId, $this->RolId);

        if ($_data) 
        {
            $this->UsuarioId = $_data["UsuarioId"];
            $this->RolId = $_data["RolId"];
            $this->RolUsuarioEst = $_data["RolUsuarioEst"];
          
            $this->UsuarioNombre = $_data["UsuarioNombre"];
            $this->UsuarioEmail = $_data["UsuarioEmail"];
            $this->UsuarioTipo = $_data["UsuarioTipo"];

            $dateUsuarioFch = isset($_data["RolUsuarioFch"]) ? $_data["RolUsuarioFch"] : "";
            $dateUsuarioExp = isset($_data["RolUsuarioExp"]) ? $_data["RolUsuarioExp"] : "";

            $this->RolUsuarioFch = date("Y-m-d", strtotime($dateUsuarioFch));
            $this->RolUsuarioExp = date("Y-m-d", strtotime($dateUsuarioExp));

            $this->_setViewData();
        }
    }

    private function _loadPostData()
    {
        $this->UsuarioId = isset($_POST["UsuarioId"]) ? $_POST["UsuarioId"] : 0;
        $this->UsuarioId2 = isset($_POST["UsuarioId2"]) ? $_POST["UsuarioId2"] : "";
        $this->RolId = isset($_POST["RolId"]) ? $_POST["RolId"] : 0;
        $this->RolId2 = isset($_POST["RolId2"]) ? $_POST["RolId2"] : "";
        $this->RolUsuarioEst = isset($_POST["RolUsuarioEst"]) ? $_POST["RolUsuarioEst"] : "";
        $this->RolUsuarioExp = isset($_POST["RolUsuarioExp"]) ? $_POST["RolUsuarioExp"] : "";

        if($this->mode == "INS")
        {
            if(!empty(\Dao\Mnt\RolesUsuarios::getOne($this->UsuarioId2, $this->RolId2)))
            {
                $this->aErrors[] = "El rol ya se encuentra registrado para este usuario.";
            }
        }

        if($this->mode == "UPD")
        {
            if (\Utilities\Validators::IsEmpty($this->RolUsuarioExp)) 
            {
                $this->aErrors[] = "La fecha de expiración no puede ir vacía.";
            }
        }
        
        $this->hasErrors = (count($this->aErrors) > 0);
        $this->_setViewData();
    }

    private function _setViewData()
    {
        $this->RolUsuarioEst_ACT = ($this->RolUsuarioEst === "ACT") ? "selected" : "";
        $this->RolUsuarioEst_INA = ($this->RolUsuarioEst === "INA") ? "selected" : "";

        $this->mode_dsc = sprintf(
            $this->mode_adsc[$this->mode],
            $this->UsuarioId,
            $this->RolId
        );

        $this->onlyDisplayIns = ($this->mode=="INS") ? true: false;
        $this->notDisplayIns = ($this->mode=="INS") ? false : true;
        $this->disabled = ($this->mode == "INS" || $this->mode =="DEL" || $this->mode =="DSP") ? "disabled" : "";
        $this->readonly = ($this->mode =="DEL" || $this->mode=="DSP") ? "readonly" : "";
        $this->allInfoDisplayed = ($this->mode =="UPD" || $this->mode =="DEL" || $this->mode=="DSP") ? true : false;
        $this->showaction = !($this->mode == "DSP");
    }
}

?>