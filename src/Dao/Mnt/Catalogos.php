<?php 
namespace Dao\Mnt;
use Dao\Table;
class Catalogos extends Table
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
}
?>