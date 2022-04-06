<?php 

namespace Controllers\Mnt\Proveedores;

use Controllers\PublicController;
use Views\Renderer;

class Proveedores extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["proveedores"] = \Dao\Mnt\Proveedores::obtenerProveedores();
        Renderer::render('mnt/proveedores', $viewData);
    }
}
?>