<?php 

namespace Controllers\Admin;

class Usuario extends \Controllers\PrivateController
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
    private $UsuarioEmail = "";
    private $UsuarioNombre = "";
    private $UsuarioPswd = "";
    private $UsuarioFching = "";
    private $UsuarioPswdEst = "";
    private $UsuarioPswdExp = "";
    private $UsuarioEst = "";
    private $UsuarioActCod = "";
    private $UsuarioPswdChg = "";
    private $UsuarioTipo = "";
    private $UsuarioEst_ACT = "";
    private $UsuarioEst_INA = "";
    private $UsuarioTipo_PBL = "";
    private $UsuarioTipo_ADM = "";
    private $UsuarioTipo_AUD = "";

    private $mode = "";
    private $mode_dsc = "";
    private $mode_adsc = array(
        "INS" => "Nuevo Usuario",
        "UPD" => "Editar Código: %s Nombre: %s",
        "DEL" => "Eliminar Código: %s Nombre: %s",
        "DSP" => "Visualizar Código: %s Nombre: %s"
    );

    private $notDisplayIns = false;
    private $allInfoDisplayed = false;
    private $disabled = "";
    private $readonly = "";
    private $showaction= true;

    private $hasErrors = false;
    private $aErrors = array();

    private $updPswd = false;

    public function run() :void
    {
        $this->mode = isset($_GET["mode"])?$_GET["mode"]:"";
        $this->UsuarioId = isset($_GET["UsuarioId"])?$_GET["UsuarioId"]:"";
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
                        if (\Dao\Security\Security::insertUsuarioFromAdmin($this->UsuarioEmail, $this->UsuarioNombre, $this->UsuarioPswd, $this->UsuarioTipo)) 
                        {
                            \Utilities\Site::redirectToWithMsg(
                                "index.php?page=admin_usuarios",
                                "¡Usuario Agregado Satisfactoriamente!"
                            );
                        }
                    break;

                    case "UPD":
                        if(!$this->updPswd)
                        {
                            if (\Dao\Security\Security::updateUsuarioAdmin($this->UsuarioId, $this->UsuarioEmail, $this->UsuarioNombre, $this->UsuarioEst, $this->UsuarioTipo)) 
                            {
                                \Utilities\Site::redirectToWithMsg(
                                    "index.php?page=admin_usuarios",
                                    "¡Usuario Actualizado Satisfactoriamente!"
                                );
                            }
                        }
                        else
                        {
                            if (\Dao\Security\Security::updateUsuarioWithPswdAdmin($this->UsuarioId, $this->UsuarioEmail, $this->UsuarioNombre, $this->UsuarioPswd, 
                            $this->UsuarioEst, $this->UsuarioTipo)) 
                            {
                                \Utilities\Site::redirectToWithMsg(
                                    "index.php?page=admin_usuarios",
                                    "¡Usuario Actualizado Satisfactoriamente!"
                                );
                            }
                        }
                        
                    break;

                    case "DEL":
                        if (\DAO\Security\Security::deleteUsuarioAdmin($this->UsuarioId)) {
                            \Utilities\Site::redirectToWithMsg(
                                "index.php?page=admin_usuarios",
                                "¡Usuario Eliminado Satisfactoriamente!"
                            );
                        }
                    break;
                }
            }
        }

        $dataview = get_object_vars($this);
        \Views\Renderer::render("admin/usuario", $dataview);
    }

    private function _load()
    {
        $_data = \Dao\Security\Security::getUsuariobyId($this->UsuarioId);
        if ($_data) 
        {
            $this->UsuarioId = $_data["UsuarioId"];
            $this->UsuarioEmail = $_data["UsuarioEmail"];
            $this->UsuarioNombre = $_data["UsuarioNombre"];
            $this->UsuarioFching = $_data["UsuarioFching"];
            $this->UsuarioPswdEst = $_data["UsuarioPswdEst"];
            $this->UsuarioPswdExp = $_data["UsuarioPswdExp"];
            $this->UsuarioEst = $_data["UsuarioEst"];
            $this->UsuarioActCod = $_data["UsuarioActCod"];
            $this->UsuarioPswdChg = $_data["UsuarioPswdChg"];
            $this->UsuarioTipo = $_data["UsuarioTipo"];
            $this->_setViewData();
        }
    }

    private function _loadPostData()
    {
        $this->UsuarioId = isset($_POST["UsuarioId"]) ? $_POST["UsuarioId"] : 0 ;
        $this->UsuarioEmail = isset($_POST["UsuarioEmail"]) ? $_POST["UsuarioEmail"] : "" ;
        $this->UsuarioNombre = isset($_POST["UsuarioNombre"]) ? $_POST["UsuarioNombre"] : "";
        $this->UsuarioPswd = isset($_POST["UsuarioPswd"]) ? $_POST["UsuarioPswd"] : "";
        $this->UsuarioEst = isset($_POST["UsuarioEst"]) ? $_POST["UsuarioEst"] : "";
        $this->UsuarioTipo = isset($_POST["UsuarioTipo"]) ? $_POST["UsuarioTipo"] : "";

        if (\Utilities\Validators::IsEmpty($this->UsuarioEmail)) 
        {
            $this->aErrors[] = "El correo no puede ir vacio";
        }

        if (!\Utilities\Validators::IsValidEmail($this->UsuarioEmail)) 
        {
            $this->aErrors[] = "El correo no es válido";
        }

        if(\Utilities\Validators::IsEmpty($this->UsuarioNombre))
        {
            $this->aErrors[] = "El nombre no puede ir vacio";
        }

        if(!(\Utilities\Validators::ValidarSoloLetras($this->UsuarioNombre)))
        {
            $this->aErrors[] = "El nombre no es válido.";
        }

        if($this->mode == "INS")
        {
            if (\Utilities\Validators::IsEmpty($this->UsuarioPswd)) 
            {
                $this->aErrors[] = "La contraseña no puede ir vacia";
            }

            if (!\Utilities\Validators::IsValidPassword($this->UsuarioPswd)) 
            {
                $this->aErrors[] = "La contraseña debe contener almenos 8 caracteres, 1 número, 1 mayúscula y 1 símbolo especial";
            }

            if(!empty(\Dao\Security\Security::getUsuarioByEmail($this->UsuarioEmail)))
            {
                $this->aErrors[] = "El correo proporcionado ya se encuentra ingresado.";
            }
        }

        if($this->mode == "UPD")
        {
            if(!empty(\Dao\Security\Security::getUsuarioDifferbyEmail($this->UsuarioId, $this->UsuarioEmail)))
            {
                $this->aErrors[] = "El correo proporcionado ya se encuentra ingresado.";
            }

            if(!empty($this->UsuarioPswd))
            {
                if (!\Utilities\Validators::IsValidPassword($this->UsuarioPswd)) 
                {
                    $this->aErrors[] = "La contraseña debe contener almenos 8 caracteres, 1 número, 1 mayúscula y 1 símbolo especial";
                }

                $this->updPswd = true;
            }
        }

        $this->hasErrors = (count($this->aErrors) > 0);
        $this->_setViewData();
    }

    private function _setViewData()
    {
        $this->UsuarioEst_ACT = ($this->UsuarioEst === "ACT") ? "selected" : "";
        $this->UsuarioEst_INA = ($this->UsuarioEst === "INA") ? "selected" : "";

        $this->UsuarioTipo_ADM = ($this->UsuarioTipo === "ADM") ? "selected" : "";
        $this->UsuarioTipo_AUD = ($this->UsuarioTipo === "AUD") ? "selected" : "";
        $this->UsuarioTipo_PBL = ($this->UsuarioTipo === "PBL") ? "selected" : "";

        $this->mode_dsc = sprintf(
            $this->mode_adsc[$this->mode],
            $this->UsuarioId,
            $this->UsuarioNombre
        );

        $this->notDisplayIns = ($this->mode=="INS") ? false : true;
        $this->disabled = ($this->mode == "INS" || $this->mode =="DEL" || $this->mode =="DSP") ? "disabled" : "";
        $this->readonly = ($this->mode =="DEL" || $this->mode=="DSP") ? "readonly" : "";
        $this->allInfoDisplayed = ($this->mode =="DEL" || $this->mode=="DSP") ? true : false;
        $this->showaction = !($this->mode == "DSP");
    }
}

?>