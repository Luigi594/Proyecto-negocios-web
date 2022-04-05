<?php 

namespace Dao\Mnt;

use Dao\Table;
class Clientes extends Table
{
    public static function obtenerClientes()
    {
       $sqlstr = "SELECT * FROM clientes; ";
       return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }

    public static function obtenerClientesId($idCliente)
    {
        $sqlstr = "SELECT * FROM clientes where idCliente = :idCliente; ";
        return self::obtenerUnRegistro(
             $sqlstr,
             array("idCliente"=>$idCliente)
        );
    }

    public static function nuevoCliente($nombre, $apellido, $telefono, $rtn, $fechaNacimiento, $estado){

        $sqlstr = "INSERT INTO clientes(nombre, apellido, telefono, rtn, fechaNacimiento, estado)
        VALUES(:nombre, :apellido, :telefono, :rtn, :fechaNacimiento, :estado); ";

        return self::executeNonQuery(
            $sqlstr,
            array(
                "nombre" => $nombre,
                "apellido" => $apellido,
                "telefono" => $telefono,
                "rtn" => $rtn,
                "fechaNacimiento" => $fechaNacimiento,
                "estado" => $estado,
            )
        );
    }

    public static function modificarCliente($nombre, $apellido, $telefono, $rtn, $fechaNacimiento, $estado, $idCliente){

        $sqlstr = "UPDATE clientes SET
        nombre = :nombre, apellido = :apellido, 
        telefono = :telefono, rtn = :rtn, 
        fechaNacimiento = :fechaNacimiento,
        estado = :estado,
        WHERE idCliente = :idCliente; ";

        return self::executeNonQuery(
            $sqlstr,
            array(
                "nombre" => $nombre,
                "apellido" => $apellido,
                "telefono" => $telefono,
                "rtn" => $rtn,
                "fechaNacimiento" => $fechaNacimiento,
                "estado" => $estado,
                "idCliente" => $idCliente
            )
        );
    }

    public static function eliminarCliente($idCliente){

        $sqlstr = "DELETE FROM clientes WHERE idCliente = :idCliente; ";

        return self::executeNonQuery(
            $sqlstr,
            array("idCliente" => $idCliente)
        );
    }
}

?>