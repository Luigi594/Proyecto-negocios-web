<?php 

namespace Controllers\Mnt\Clientes;

use Controllers\PublicController;
use Views\Renderer;

class Clientes extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["clientes"] = \Dao\Mnt\Clientes::obtenerClientes();
        Renderer::render('mnt/clientes', $viewData);
    }
}
?>