<?php

namespace Dao\Mnt;

use Dao\Security\Estados;

class FuncionesRoles extends \Dao\Table
{
    public static function getAll()
    {
        return self::obtenerRegistros("SELECT * FROM funcionesroles;", array());
    }

    public static function getOne($RolId, $FuncionId)
    {
        $sqlstr = "SELECT * FROM funcionesroles WHERE RolId=:RolId AND FuncionId=:FuncionId;";
        return self::obtenerUnRegistro($sqlstr, array("RolId"=>$RolId, "FuncionId"=>$FuncionId));
    }

    public static function insert($RolId, $FuncionId)
    {
        $insstr = "INSERT INTO funcionesroles VALUES (:RolId, :FuncionId, :FuncionRolEst, :FuncionExp);";
        return self::executeNonQuery(
            $insstr,
            array("RolId"=>$RolId, "FuncionId"=>$FuncionId, "FuncionRolEst"=>Estados::ACTIVO, "FuncionExp"=>(date('Y-m-d', time() + 155520000)))  //5*12*30*24*60*60 (y m d h mi s)))
        );
    }

    public static function update($RolId, $FuncionId, $FuncionRolEst, $FuncionExp)
    {
        $updsql = "UPDATE funcionesroles SET FuncionRolEst=:FuncionRolEst, FuncionExp=:FuncionExp WHERE RolId=:RolId AND FuncionId=:FuncionId;";
        return self::executeNonQuery(
            $updsql,
            array("FuncionRolEst" => $FuncionRolEst, "FuncionExp" => $FuncionExp, "RolId" => $RolId, "FuncionId"=>$FuncionId)
        );
    }

    public static function delete($RolId, $FuncionId)
    {
        $delsql = "DELETE FROM funcionesroles WHERE RolId=:RolId AND FuncionId=:FuncionId;";
        return self::executeNonQuery(
            $delsql,
            array("RolId" => $RolId, "FuncionId" => $FuncionId)
        );
    }

    static public function searchFuncionesRoles($UsuarioBusqueda)
    {
        $sqlstr = "SELECT * FROM funcionesroles WHERE RolId LIKE :UsuarioBusqueda
        OR FuncionId LIKE :UsuarioBusqueda OR FuncionRolEst LIKE :UsuarioBusqueda OR FuncionExp LIKE :UsuarioBusqueda;";
        
        return self::obtenerRegistros($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%"));
    }

    static public function getRoles()
    {
        return self::obtenerRegistros("SELECT * FROM roles WHERE RolEst = 'ACT';", array());
    }

    static public function getFunciones()
    {
        return self::obtenerRegistros("SELECT * FROM funciones WHERE FuncionEst = 'ACT';", array());
    }

}

?>
