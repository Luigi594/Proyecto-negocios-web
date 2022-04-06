<?php 

namespace Dao\Mnt;

use Dao\Table;
class Puestos extends Table
{
    public static function obtenerTodos()
    {
       $sqlstr = "select * from puestos; ";
       return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }

    public static function obtenerPorPtsId($idPuesto)
    {
        $sqlstr = "select * from puestos where idPuesto=:idPuesto; ";
        return self::obtenerUnRegistro(
             $sqlstr,
             array("idPuesto"=>$idPuesto)
        );
    }   
    
    public static function nuevoPuesto($descripcion){
        $sqlstr = "INSERT INTO puestos (descripcion) 
                    VALUES (:descripcion);";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "descripcion"=>$descripcion
            )
        );
    }

    public static function actualizarPuesto($descripcion, $idPuesto){
        $sqlstr = "UPDATE puestos set idPuesto=:idPuesto, descripcion=:descripcion 
                    where idPuesto=:idPuesto;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "descripcion"=>$descripcion,
                "idPuesto"=>$idPuesto
            )
        );
    }

    public static function eliminarPuesto($idPuesto){
        $sqlstr = "DELETE FROM puestos where idPuesto=:idPuesto;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "idPuesto"=>$idPuesto
            )
        );
    }
}

?>