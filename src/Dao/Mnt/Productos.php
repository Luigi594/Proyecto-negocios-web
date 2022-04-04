<?php 

namespace Dao\Mnt;

use Dao\Table;
class Productos extends Table
{
    public static function obtenerTodos()
    {
       $sqlstr = "select * from productos; ";
       return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }

    public static function obtenerPorProId($idProducto)
    {
        $sqlstr = "select * from productos where idProducto=:idProducto; ";
        return self::obtenerUnRegistro(
             $sqlstr,
             array("idProducto"=>$idProducto)
        );
    }   
    
    public static function nuevoProducto($idReceta, $nombre, $descripcion, $precio, $estado){
        $sqlstr = "INSERT INTO productos (idReceta, nombre, descripcion, precio, estado) 
                    VALUES (:idReceta, :nombre, :descripcion, :precio, :estado);";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "idReceta"=>$idReceta,
                "nombre"=>$nombre,
                "descripcion"=>$descripcion,
                "precio"=>$precio,
                "estado"=>$estado
            )
        );
    }

    public static function actualizarProducto($idReceta, $nombre, $descripcion, $precio, $estado, $idProducto){
        $sqlstr = "UPDATE productos set idReceta=:idReceta, nombre=:nombre, descripcion=:descripcion, 
                        precio=:precio, estado=:estado where idProducto=:idProducto;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "idReceta"=>$idReceta,
                "nombre"=>$nombre,
                "descripcion"=>$descripcion,
                "precio"=>$precio,
                "estado"=>$estado,
                "idProducto"=>$idProducto
            )
        );
    }

    public static function eliminarProducto($idProducto){
        $sqlstr = "DELETE FROM productos where idProducto=:idProducto;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "idProducto"=>$idProducto
            )
        );
    }
}

?>