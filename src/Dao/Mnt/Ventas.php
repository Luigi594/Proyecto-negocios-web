<?php

namespace Dao\Mnt;

use Dao\Table;

class Ventas extends Table
{
    public static function obtenerTodos()
    {
        $sqlstr = "SELECT * FROM ventas v
        join clientes c on v.clienteId = c.idCliente";
        return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }

    public static function obtenerPorId($clienteId)
    {
        $sqlstr = "select * from ventas where clienteId=:clienteId;";
        return self::obtenerUnRegistro(
            $sqlstr,
            array("clienteId"=>$clienteId)
        );
    }

    public static function nuevaVenta($clienteId, $fechaVenta ,$tipoPago, $estadoVenta, $fechaEntrega, $estadoEntrega, $docsMeta)
    {
        $sqlstr= "INSERT INTO ventas (clienteId, fechaVenta, tipoPago, estadoVenta, fechaEntrega, estadoEntrega, docsMeta) values (:clienteId, :fechaVenta,:tipoPago, :estadoVenta, :fechaEntrega, :estadoEntrega, :docsMeta);";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "clienteId"=>$clienteId,
                "fechaVenta"=>$fechaVenta,
                "tipoPago"=>$tipoPago,
                "estadoVenta"=>$estadoVenta,
                "fechaEntrega"=>$fechaEntrega,
                "estadoEntrega"=>$estadoEntrega,
                "docsMeta"=>$docsMeta,
            )
        );
    }

}


?>
