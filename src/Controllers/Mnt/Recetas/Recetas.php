<?php 

namespace Controllers\Mnt\Recetas;

use Controllers\PublicController;
use Views\Renderer;
/*
`productos`
`idRecetas` BIGINT(8) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(250) NULL,
  `estado` ENUM NOT NULL DEFAULT 'ACT','INA',
*/
class Recetas extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["recetas"] 
                        = \Dao\Mnt\Recetas::obtenerTodos();
        Renderer::render('mnt/recetas', $viewData);
    }
}
?>