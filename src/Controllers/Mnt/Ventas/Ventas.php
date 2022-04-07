<?php
namespace Controllers\Mnt\Ventas;

use Controllers\PublicController;
use Views\Renderer;

/*
`ventas` (
  `idVenta` int NOT NULL AUTO_INCREMENT,
  `clienteId` int NOT NULL,
  `fechaVenta` datetime NOT NULL,
  `tipoPago` varchar(256) NOT NULL,
  `estadoVenta` enum('VND','PND','CNL') DEFAULT NULL,
  `fechaEntrega` datetime DEFAULT NULL,
  `estadoEntrega` enum('RCB','PND','CNL') DEFAULT NULL,
  `docsMeta` mediumtext,
  PRIMARY KEY (`idVenta`),
  KEY `fk_ventas_clientes_idx` (`clienteId`),
  CONSTRAINT `fk_ventas_clientes` FOREIGN KEY (`clienteId`) REFERENCES `clientes` (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
*/

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
