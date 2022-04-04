<?php 

namespace Dao\Mnt;

use Dao\Table;
class Recetas extends Table
{
    public static function obtenerTodos()
    {
       $sqlstr = "select * from recetas; ";
       return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }

    public static function obtenerPorRecId($idRecetas)
    {
        $sqlstr = "select * from recetas where idRecetas=:idRecetas; ";
        return self::obtenerUnRegistro(
             $sqlstr,
             array("idRecetas"=>$idRecetas)
        );
    }   
    
    public static function nuevaReceta($descripcion, $estado){
        $sqlstr = "INSERT INTO recetas (descripcion, estado) 
                    VALUES (:descripcion, :estado);";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "descripcion"=>$descripcion,
                "estado"=>$estado
            )
        );
    }

    public static function actualizarReceta($descripcion, $estado, $idRecetas){
        $sqlstr = "UPDATE recetas set idRecetas=:idRecetas, descripcion=:descripcion, estado=:estado 
                    where idRecetas=:idRecetas;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "descripcion"=>$descripcion,
                "estado"=>$estado,
                "idRecetas"=>$idRecetas
            )
        );
    }

    public static function eliminarReceta($idRecetas){
        $sqlstr = "DELETE FROM recetas where idRecetas=:idRecetas;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "idRecetas"=>$idRecetas
            )
        );
    }
}

?>