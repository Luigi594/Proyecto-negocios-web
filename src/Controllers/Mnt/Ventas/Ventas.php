<?php
namespace Controllers\Mnt\Ventas;

use Controllers\PublicController;
use Views\Renderer;


class Ventas extends PublicController
{
    private $_viewData = array();
    public function run():void
    {
        $this->_viewData["ventas"] = \Dao\Mnt\Ventas::obtenerTodos();
        Renderer::render('mnt/ventas', $this->_viewData);
    }
}

?>
