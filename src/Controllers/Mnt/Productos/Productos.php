<?php 

namespace Controllers\Mnt\Productos;

use Controllers\PublicController;
use Views\Renderer;
/*
`productos`
`idProducto` BIGINT(8) NOT NULL AUTO_INCREMENT,
  'idReceta' BIGINT(8) NOT NULL FK, 
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(250) NULL,
  `precio` DOUBLE NULL,
  `estado` ENUM NOT NULL DEFAULT 'ACT','INA',
*/
class Productos extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["productos"] 
                        = \Dao\Mnt\Productos::obtenerTodos();
        Renderer::render('mnt/productos', $viewData);
    }
}
?>