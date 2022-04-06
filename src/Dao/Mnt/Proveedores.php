<?php 

namespace Dao\Mnt;

use Dao\Table;
class Proveedores extends Table
{
    public static function obtenerProveedores()
    {
       $sqlstr = "SELECT * FROM proveedores; ";
       return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }

    public static function obtenerProveedoresId($idProveedor)
    {
        $sqlstr = "SELECT * FROM proveedores where idProveedor = :idProveedor; ";
        return self::obtenerUnRegistro(
             $sqlstr,
             array("idProveedor"=>$idProveedor)
        );
    }

    public static function nuevoProveedor($nombreProveedor, $empresa, $direccion, $telefono,  $correo, $estado){

        $sqlstr = "INSERT INTO proveedores(nombreProveedor, empresa, direccion, telefono,  correo, estado)
        VALUES(:nombreProveedor, :empresa, :direccion, :telefono,  :correo, :estado); ";

        return self::executeNonQuery(
            $sqlstr,
            array(
                "nombreProveedor" => $nombreProveedor,
                "empresa" => $empresa,
                "direccion" => $direccion,
                "telefono" => $telefono,
                "correo" => $correo,
                "estado" => $estado,
            )
        );
    }

    public static function modificarProveedor($nombreProveedor, $empresa, $direccion, $telefono,  $correo, $estado, $idProveedor){

        $sqlstr = "UPDATE proveedores SET nombreProveedor = :nombreProveedor, empresa = :empresa, 
        direccion = :direccion, telefono = :telefono, 
        correo = :correo,
        estado = :estado
        WHERE idProveedor = :idProveedor; ";

        return self::executeNonQuery(
            $sqlstr,
            array(
                "nombreProveedor" => $nombreProveedor,
                "empresa" => $empresa,
                "direccion" => $direccion,
                "telefono" => $telefono,
                "correo" => $correo,
                "estado" => $estado,
                "idProveedor" => $idProveedor
            )
        );
    }

    public static function eliminarProveedor($idProveedor){

        $sqlstr = "DELETE FROM proveedores WHERE idProveedor = :idProveedor; ";

        return self::executeNonQuery(
            $sqlstr,
            array("idProveedor" => $idProveedor)
        );
    }
}

?>