<?php 

namespace Controllers\Mnt\Puestos;

use Controllers\PublicController;
use Views\Renderer;
/*
`puestos`
`idPuesto` BIGINT(8) NOT NULL AUTO_INCREMENT,
  `descripcionPuesto` VARCHAR(250) NULL,
*/
class Puestos extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["puestos"] 
                        = \Dao\Mnt\Puestos::obtenerTodos();
        Renderer::render('mnt/puestos', $viewData);
    }
}
?>