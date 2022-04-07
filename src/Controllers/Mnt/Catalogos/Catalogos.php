<?php 

namespace Controllers\Mnt\Catalogos;

use Controllers\PublicController;
use Views\Renderer;
/*
`productos`
`idProducto` BIGINT(8) NOT NULL AUTO_INCREMENT, 
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(250) NULL,
  `precio` DOUBLE NULL,
*/
class Catalogos extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["productos"] 
                        = \Dao\Mnt\Catalogos::obtenerTodos();
        Renderer::render('mnt/catalogos', $viewData);
    }
}
?>