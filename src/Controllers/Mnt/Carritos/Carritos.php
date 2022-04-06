<?php
namespace Controllers\Mnt\Carritos;

use Controllers\PublicController;
use Views\Renderer;

/*
`carrito` (
  `id` int NOT NULL AUTO_INCREMENT,
  `clienteId` int NOT NULL,
  `productoId` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio` decimal(13,2) NOT NULL,
  `fechahora` datetime NOT NULL,
  PRIMARY KEY (`id`)
*/
class Carritos extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["carritos"]
            = \Dao\Mnt\Carritos::obtenerTodos();
        Renderer::render('mnt/carritos', $viewData);
    }
}

?>
