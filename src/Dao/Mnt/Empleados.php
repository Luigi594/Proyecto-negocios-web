<?php 

namespace Dao\Mnt;

use Dao\Table;
class Empleados extends Table
{
    public static function obtenerEmpleados()
    {
       $sqlstr = "SELECT * FROM empleados; ";
       return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }

    public static function obtenerEmpleadosId($idEmpleado)
    {
        $sqlstr = "SELECT * FROM empleados where idEmpleado = :idEmpleado; ";
        return self::obtenerUnRegistro(
             $sqlstr,
             array("idEmpleado"=>$idEmpleado)
        );
    }

    public static function nuevoEmpleado($nombre, $apellido, $telefono, $fechaNacimiento, $estado, $puestoId){

        $sqlstr = "INSERT INTO empleados(nombre, apellido, telefono, fechaNacimiento, estado, puestoId)
        VALUES(:nombre, :apellido, :telefono, :fechaNacimiento, :estado, :puestoId); ";

        return self::executeNonQuery(
            $sqlstr,
            array(
                "nombre" => $nombre,
                "puestoId" => $puestoId,
                "apellido" => $apellido,
                "telefono" => $telefono,
                "fechaNacimiento" => $fechaNacimiento,
                "estado" => $estado,
            )
        );
    }

    public static function modificarEmpleado($nombre, $apellido, $telefono, $rtn, $fechaNacimiento, $estado, $idEmpleado){

        $sqlstr = "UPDATE clientes SET nombre = :nombre, apellido = :apellido, 
        telefono = :telefono, rtn = :rtn, 
        fechaNacimiento = :fechaNacimiento,
        estado = :estado
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

    public static function eliminarEmpleado($idCliente){

        $sqlstr = "DELETE FROM clientes WHERE idCliente = :idCliente; ";

        return self::executeNonQuery(
            $sqlstr,
            array("idCliente" => $idCliente)
        );
    }
}

?>