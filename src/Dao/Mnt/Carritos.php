<?php

namespace Dao\Mnt;

use Dao\Table;

class Carritos extends Table
{
    public static function obtenerTodos()
    {
        $sqlstr = "select * from carrito ca
        join productos p on ca.productoId = p.idProducto;";
        return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }

    public static function obtenerPorId($id)
    {
        $sqlstr = "select * from carrito where id=:id;";
        return self::obtenerUnRegistro(
            $sqlstr,
            array("id"=>$id)
        );
    }

    public static function obtenerCarrito(){

        $sqlstr = "SELECT c.id, p.nombre, p.descripcion, p.idProducto, p.precio, c.cantidad 
        from carrito c join productos p on c.productoId = p.idProducto
        join clientes cl on c.clienteId = cl.idCliente; ";

        return self::obtenerRegistros($sqlstr, array());
    }

    public static function nuevoCarrito($clienteId, $productoId, $cantidad, $precio)
    {
        $sqlstr= "INSERT INTO carrito (clienteId, productoId, cantidad, precio, fechahora) values (:clienteId, :productoId, :cantidad, :precio, now());";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "clienteId"=>$clienteId,
                "productoId"=>$productoId,
                "cantidad"=>$cantidad,
                "precio"=> $precio,
            )
        );
    }

    public static function eliminarCarrito()
    {
        $sqlstr = "DELETE FROM carrito";
        return self::executeNonQuery(
            $sqlstr,
            array()
        );
    }

    public static function eliminarItemCarrito($id)
    {
        $sqlstr = "DELETE FROM carrito where id=:id";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "id"=>$id,
            )
        );
    }
}


?>
