<?php

namespace Dao\Security;

class Bitacora extends \Dao\Table
{


    public static function insert($BitacoraPrograma, $BitacoraDescripcion, $BitacoraTipo, $BitacoraUsuario)
    {
        $insstr = "INSERT INTO bitacora (BitacoraFch, BitacoraPrograma, BitacoraDescripcion, BitacoraTipo, BitacoraUsuario) values (NOW(), :BitacoraPrograma, :BitacoraDescripcion, :BitacoraTipo, :BitacoraUsuario);";
        return self::executeNonQuery(
            $insstr,
            array(
                "BitacoraPrograma"=>$BitacoraPrograma, 
                "BitacoraDescripcion"=>$BitacoraDescripcion, 
                "BitacoraTipo"=>$BitacoraTipo,
                "BitacoraUsuario"=>$BitacoraUsuario
            )
        );
    }

}

?>