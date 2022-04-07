<?php 

namespace Controllers\Mnt\VentasDetalles;

use Controllers\PublicController;
use Views\Renderer;
/*
`ventas_detalle` (
  `idDetalle` int NOT NULL AUTO_INCREMENT,
  `idVenta` int NOT NULL,
  `idProducto` int NOT NULL,
  `cantidad` int DEFAULT NULL,
  `precio` decimal(13,2) DEFAULT NULL,
  `IVA` decimal(6,2) DEFAULT NULL,
  `observacion` varchar(256) DEFAULT NULL,
  `descuento` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`idDetalle`),
  KEY `fk_detalle_venta_idx` (`idVenta`),
  KEY `fk_detalle_producto_idx` (`idProducto`),
  CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  CONSTRAINT `fk_detalle_venta` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`idVenta`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
*/
class VentasDetalles extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["ventas_detalles"] 
                        = \Dao\Mnt\VentasDetalles::obtenerPorId();
        Renderer::render('mnt/ventas_detalles', $viewData);
    }
}
?>