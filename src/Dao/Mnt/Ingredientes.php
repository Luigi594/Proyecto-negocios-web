<?php 

namespace Dao\Mnt;

use Dao\Table;
class Ingredientes extends Table
{
    public static function obtenerTodos()
    {
       $sqlstr = "select * from ingredientes; ";
       return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }

    public static function obtenerPorIngreId($idIngrediente)
    {
        $sqlstr = "select * from ingredientes where idIngrediente=:idIngrediente; ";
        return self::obtenerUnRegistro(
             $sqlstr,
             array("idIngrediente"=>$idIngrediente)
        );
    }   
    
    public static function nuevoIngrediente($idProveedor, $nombre, $descripcion, $precio, $estado){
        $sqlstr = "INSERT INTO ingredientes (idProveedor, nombre, descripcion, precio, estado) 
                    VALUES (:idProveedor, :nombre, :descripcion, :precio, :estado);";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "idProveedor"=>$idProveedor,
                "nombre"=>$nombre,
                "descripcion"=>$descripcion,
                "precio"=>$precio,
                "estado"=>$estado
            )
        );
    }

    public static function actualizarIngrediente($idProveedor, $nombre, $descripcion, $precio, $estado, $idIngrediente){
        $sqlstr = "UPDATE ingredientes set idProveedor=:idProveedor, nombre=:nombre, descripcion=:descripcion, 
                        precio=:precio, estado=:estado where idIngrediente=:idIngrediente;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "idProveedor"=>$idProveedor,
                "nombre"=>$nombre,
                "descripcion"=>$descripcion,
                "precio"=>$precio,
                "estado"=>$estado,
                "idIngrediente"=>$idIngrediente
            )
        );
    }

    public static function eliminarIngrediente($idIngrediente){
        $sqlstr = "DELETE FROM ingredientes where idIngrediente=:idIngrediente;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "idIngrediente"=>$idIngrediente
            )
        );
    }
}

?>