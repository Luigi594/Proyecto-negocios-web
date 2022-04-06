<?php 
namespace Controllers\Mnt\Ingredientes;

use Controllers\PublicController;
use Views\Renderer;

class Ingredientes extends PublicController {

    public function run():void{

        $viewData = array();
        $viewData["ingredientes"] = \Dao\Mnt\Ingredientes::obtenerTodos();
        Renderer::render('mnt/ingredientes', $viewData);
    }
}
?>