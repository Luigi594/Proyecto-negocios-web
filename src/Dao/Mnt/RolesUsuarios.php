<?php

namespace Dao\Mnt;

use Dao\Security\Estados;

class RolesUsuarios extends \Dao\Table
{
    public static function getAll()
    {
        return self::obtenerRegistros("SELECT ru.*, u.UsuarioNombre, u.UsuarioEmail, u.UsuarioTipo 
        FROM rolesusuarios ru INNER JOIN usuarios u ON ru.UsuarioId = u.UsuarioId WHERE u.UsuarioTipo != 'PBL';", array());
    }

    public static function getOne($UsuarioId, $RolId)
    {
        $sqlstr = "SELECT ru.*, u.UsuarioNombre, u.UsuarioEmail, u.UsuarioTipo 
        FROM rolesusuarios ru INNER JOIN usuarios u ON ru.UsuarioId = u.UsuarioId 
        WHERE ru.UsuarioId=:UsuarioId AND RolId=:RolId;";
        return self::obtenerUnRegistro($sqlstr, array("UsuarioId"=>$UsuarioId, "RolId"=>$RolId));
    }

    public static function insert($UsuarioId, $RolId)
    {
        $insstr = "INSERT INTO rolesusuarios VALUES (:UsuarioId, :RolId, :RolUsuarioEst, NOW(), :RolUsuarioExp);";
        return self::executeNonQuery(
            $insstr,
            array("UsuarioId"=>$UsuarioId, "RolId"=>$RolId, "RolUsuarioEst"=>Estados::ACTIVO, "RolUsuarioExp"=>(date('Y-m-d', time() + 155520000)))  //5*12*30*24*60*60 (y m d h mi s))
        );
    }

    public static function update($UsuarioId, $RolId, $RolUsuarioEst, $RolUsuarioExp)
    {
        $updsql = "UPDATE rolesusuarios SET RolUsuarioEst=:RolUsuarioEst, RolUsuarioExp=:RolUsuarioExp WHERE Usuarioid=:UsuarioId AND RolId=:RolId;";
        return self::executeNonQuery(
            $updsql,
            array("RolUsuarioEst" => $RolUsuarioEst, "RolUsuarioExp" => $RolUsuarioExp, "UsuarioId"=>$UsuarioId, "RolId" => $RolId,)
        );
    }

    public static function delete($UsuarioId, $RolId)
    {
        $delsql = "DELETE FROM rolesusuarios WHERE UsuarioId=:UsuarioId AND RolId=:RolId;";
        return self::executeNonQuery(
            $delsql,
            array("UsuarioId" => $UsuarioId, "RolId" => $RolId)
        );
    }

    static public function searchRolesUsuarios($UsuarioBusqueda)
    {
        $sqlstr = "SELECT ru.*, u.UsuarioNombre, u.UsuarioEmail, u.UsuarioTipo FROM rolesusuarios ru 
        INNER JOIN usuarios u ON ru.UsuarioId = u.UsuarioId WHERE ru.UsuarioId LIKE :UsuarioBusqueda 
        OR UsuarioNombre LIKE :UsuarioBusqueda OR UsuarioEmail LIKE :UsuarioBusqueda OR UsuarioTipo LIKE :UsuarioBusqueda
        OR RolId LIKE :UsuarioBusqueda OR RolUsuarioEst LIKE :UsuarioBusqueda 
        OR RolUsuarioFch LIKE :UsuarioBusqueda OR RolUsuarioExp LIKE :UsuarioBusqueda;";
        
        return self::obtenerRegistros($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%"));
    }

    static public function getUsuarios()
    {
        return self::obtenerRegistros("SELECT * FROM usuarios WHERE UsuarioTipo!='PBL';", array());
    }

    static public function getRoles()
    {
        return self::obtenerRegistros("SELECT * FROM roles WHERE RolEst = 'ACT';", array());
    }

}

?>
