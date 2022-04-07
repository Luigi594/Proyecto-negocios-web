<?php 

namespace Controllers\Admin;

class Roles extends \Controllers\PrivateController
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
    
    private $UsuarioBusqueda = "";

    public function run() :void
    {
        $dataview = array();

        if ($this->isPostBack()) 
        {   
            $this->UsuarioBusqueda = isset($_POST["UsuarioBusqueda"]) ? $_POST["UsuarioBusqueda"] : "";

            if(!empty($this->UsuarioBusqueda))
            {
                $dataview["items"] = \Dao\Mnt\Roles::searchRoles($this->UsuarioBusqueda);
                \Utilities\Context::setContext("UsuarioBusqueda", $this->UsuarioBusqueda);
            }
            else
            {
                $dataview["items"] = \Dao\Mnt\Roles::getAll();
            }
        } 
        else
        {   
            $dataview["items"] = \Dao\Mnt\Roles::getAll();
        }
        
        \Views\Renderer::render("admin/roles", $dataview);
    }
}

// index.php?page=mntRoles_roles