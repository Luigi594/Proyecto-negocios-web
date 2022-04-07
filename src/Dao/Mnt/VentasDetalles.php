<?php 

namespace Dao\Mnt;
use Dao\Table;

class VentasDetalles extends Table
{
    public static function obtenerTodos()
    {
       $sqlstr = "select * from ventas_detalle; ";
       return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }

    public static function obtenerPorId($idVenta)
    {
        $sqlstr = "select * from ventas_detalle where idVenta=:idVenta; ";
        return self::obtenerUnRegistro(
             $sqlstr,
             array("idVenta"=>$idVenta)
        );
    }   
    
    public static function nuevoDetalle($idVenta, $idProducto, $cantidad, $precio, $IVA, $observacion, $descuento){
        $sqlstr = "INSERT INTO ventas_detalle (idVenta, idProducto, cantidad, precio, IVA, observacion, descuento) 
                    VALUES (:idVenta, :idProducto, :cantidad, :precio, :IVA ,:observacion, :descuento);";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "idVenta"=>$idVenta,
                "idProducto"=>$idProducto,
                "cantidad"=>$cantidad,
                "precio"=>$precio,
                "IVA"=>$IVA,
                "observacion"=>$observacion,
                "descuento"=>$descuento
            )
        );
    }

}

?>