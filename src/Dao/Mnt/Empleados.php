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

    public static function nuevoEmpleado($nombre, $apellido, $puestoId, $telefono, $fechaNacimiento, $estado){

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

    public static function modificarEmpleado($nombre, $apellido, $puestoId, $telefono,  $fechaNacimiento, $estado, $idEmpleado){

        $sqlstr = "UPDATE empleados SET puestoId = :puestoId, nombre = :nombre, apellido = :apellido, telefono = :telefono, rtn = :rtn, fechaNacimiento = :fechaNacimiento,estado = :estado
        WHERE idEmpleado = :idEmpleado; ";

        return self::executeNonQuery(
            $sqlstr,
            array(
                "nombre" => $nombre,
                "apellido" => $apellido,
                "puestoId" => $puestoId,
                "telefono" => $telefono,
                "fechaNacimiento" => $fechaNacimiento,
                "estado" => $estado,
                "idEmpleado" => $idEmpleado
            )
        );
    }

    public static function eliminarEmpleado($idEmpleado){

        $sqlstr = "DELETE FROM empleados WHERE idEmpleado = :idEmpleado; ";

        return self::executeNonQuery(
            $sqlstr,
            array("idEmpleado" => $idEmpleado)
        );
    }
}

?>