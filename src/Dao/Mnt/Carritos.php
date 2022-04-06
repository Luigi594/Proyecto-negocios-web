<?php

namespace Dao\Mnt;

use Dao\Table;

class Carritos extends Table
{
    public static function obtenerTodos()
    {
        $sqlstr = "select * from carrito;";
        return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }

    public static function obtenerPorId($clienteId)
    {
        $sqlstr = "select * from carrito where clienteId=:clienteId;";
        return self::obtenerUnRegistro(
            $sqlstr,
            array("clienteId"=>$clienteId)
        );
    }

    public static function nuevoCarrito($clienteId, $productoId, $cantidad, $precio, $fechahora)
    {
        $sqlstr= "INSERT INTO carrito (clienteId, productoId, cantidad, precio, fechahora) values (:clienteId, :productoId, :cantidad, :precio, :fechahora);";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "clienteId"=>$clienteId,
                "productoId"=>$productoId,
                "cantidad"=>$cantidad,
                "precio"=> $precio,
                "fechahora"=> $fechahora,
            )
        );
    }

    public static function actualizarCarrito($clienteId, $productoId, $cantidad, $precio, $fechahora)
    {
        $sqlstr = "UPDATE carrito set productoId=:productoId, cantidad=:cantidad, precio=:precio, fechahora=:fechahora where clienteId=:clienteId";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "productoId"=>$productoId,
                "cantidad"=>$cantidad,
                "precio"=> $precio,
                "fechahora"=> $fechahora,
            )
        );
    }
    
    public static function eliminarCarrito($clienteId)
    {
        $sqlstr = "DELETE FROM carrito where clienteId=:clienteId;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "clienteId"=>$clienteId
            )
        );
    }

    public static function eliminarItemCarrito($clienteId, $productoId)
    {
        $sqlstr = "DELETE FROM carrito where clienteId=:clienteId && productoId=:productoId;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "clienteId"=>$clienteId,
                "productoId"=>$productoId
            )
        );
    }
}


?>
