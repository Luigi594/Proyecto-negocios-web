<?php 

namespace Controllers\Mnt\Empleados;

use Controllers\PublicController;
use Views\Renderer;

class Empleados extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["Empleados"] = \Dao\Mnt\Empleados::obtenerEmpleados();
        Renderer::render('mnt/Empleados', $viewData);
    }
}
?>