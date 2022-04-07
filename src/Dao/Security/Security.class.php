<?php

    namespace Dao\Security;

    if (version_compare(phpversion(), '7.4.0', '<')) {
            define('PASSWORD_ALGORITHM', 1);  //BCRYPT
    } 
    else 
    {
        define('PASSWORD_ALGORITHM', '2y');  //BCRYPT
    }

    use Exception;

    class Security extends \Dao\Table
    {
        public static function getAll()
        {
            return self::obtenerRegistros("SELECT * FROM usuarios ORDER BY UsuarioTipo;;", array());
        }

        static public function insertUsuarioFromCliente($UsuarioEmail, $UsuarioNombre, $UsuarioPswd)
        {
            if (!\Utilities\Validators::IsValidEmail($UsuarioEmail)) 
            {
                throw new Exception("Correo no es válido");
            }
            if (!\Utilities\Validators::IsValidPassword($UsuarioPswd)) 
            {
                throw new Exception("Contraseña debe ser almenos 8 caracteres, 1 número, 1 mayúscula, 1 símbolo especial");
            }

            $usuario = self::_usuarioStruct();
            //Tratamiento de la Contraseña
            $hashedPassword = self::_hashPassword($UsuarioPswd);

            unset($usuario["UsuarioId"]);
            unset($usuario["UsuarioFching"]);
            unset($usuario["UsuarioPswdChg"]);

            $usuario["UsuarioEmail"] = $UsuarioEmail;
            $usuario["UsuarioNombre"] = $UsuarioNombre;
            $usuario["UsuarioPswd"] = $hashedPassword;
            $usuario["UsuarioPswdEst"] = Estados::ACTIVO;
            $usuario["UsuarioPswdExp"] = date('Y-m-d', time() + 7776000);  //(3*30*24*60*60) (m d h mi s)
            $usuario["UsuarioEst"] = Estados::ACTIVO;
            $usuario["UsuarioActCod"] = hash("sha256", $UsuarioEmail.time());
            $usuario["UsuarioTipo"] = UsuarioTipo::PUBLICO;

            $sqlIns = "INSERT INTO `usuarios` (`UsuarioEmail`, `UsuarioNombre`, `UsuarioPswd`,
                `UsuarioFching`, `UsuarioPswdEst`, `UsuarioPswdExp`, `UsuarioEst`, `UsuarioActCod`,
                `UsuarioPswdChg`, `UsuarioTipo`)
                VALUES
                ( :UsuarioEmail, :UsuarioNombre, :UsuarioPswd,
                now(), :UsuarioPswdEst, :UsuarioPswdExp, :UsuarioEst, :UsuarioActCod,
                now(), :UsuarioTipo);";

            return self::executeNonQuery($sqlIns, $usuario);
        }

        static public function insertUsuarioFromAdmin($UsuarioEmail, $UsuarioNombre, $UsuarioPswd, $UsuarioTipo)
        {
            if (!\Utilities\Validators::IsValidEmail($UsuarioEmail)) 
            {
                throw new Exception("Correo no es válido");
            }
            
            if (!\Utilities\Validators::IsValidPassword($UsuarioPswd)) 
            {
                throw new Exception("Contraseña debe ser almenos 8 caracteres, 1 número, 1 mayúscula, 1 símbolo especial");
            }      
            
            $usuario = self::_usuarioStruct();
            //Tratamiento de la Contraseña
            $hashedPassword = self::_hashPassword($UsuarioPswd);

            unset($usuario["UsuarioId"]);
            unset($usuario["UsuarioFching"]);
            unset($usuario["UsuarioPswdChg"]);

            $usuario["UsuarioEmail"] = $UsuarioEmail;
            $usuario["UsuarioNombre"] = $UsuarioNombre;
            $usuario["UsuarioPswd"] = $hashedPassword;
            $usuario["UsuarioPswdEst"] = Estados::ACTIVO;
            $usuario["UsuarioPswdExp"] = date('Y-m-d', time() + 7776000);  //(3*30*24*60*60) (m d h mi s)
            $usuario["UsuarioEst"] = Estados::ACTIVO;
            $usuario["UsuarioActCod"] = hash("sha256", $UsuarioEmail.time());
            $usuario["UsuarioTipo"] = $UsuarioTipo;

            $sqlIns = "INSERT INTO `usuarios` (`UsuarioEmail`, `UsuarioNombre`, `UsuarioPswd`,
                `UsuarioFching`, `UsuarioPswdEst`, `UsuarioPswdExp`, `UsuarioEst`, `UsuarioActCod`,
                `UsuarioPswdChg`, `UsuarioTipo`)
                VALUES
                ( :UsuarioEmail, :UsuarioNombre, :UsuarioPswd,
                now(), :UsuarioPswdEst, :UsuarioPswdExp, :UsuarioEst, :UsuarioActCod,
                now(), :UsuarioTipo);";

            return self::executeNonQuery($sqlIns, $usuario);
        }

        static public function updateUsuarioAdmin($UsuarioId, $UsuarioEmail, $UsuarioNombre, $UsuarioEst,
        $UsuarioTipo)
        {
            if (!\Utilities\Validators::IsValidEmail($UsuarioEmail)) 
            {
                throw new Exception("Correo no es válido");
            }

            $usuario = self::_usuarioStruct();

            unset($usuario["UsuarioPswd"]);
            unset($usuario["UsuarioFching"]);   
            unset($usuario["UsuarioPswdEst"]);  
            unset($usuario["UsuarioPswdExp"]);  
            unset($usuario["UsuarioEst"]);     
            unset($usuario["UsuarioActCod"]);   
            unset($usuario["UsuarioPswdChg"]); 

            $usuario["UsuarioId"] = $UsuarioId;
            $usuario["UsuarioEmail"] = $UsuarioEmail;
            $usuario["UsuarioNombre"] = $UsuarioNombre;
            $usuario["UsuarioEst"] = $UsuarioEst;
            $usuario["UsuarioActCod"] = hash("sha256", $UsuarioEmail.time());
            $usuario["UsuarioTipo"] = $UsuarioTipo;

            $sqlIns = "UPDATE `usuarios` SET UsuarioEmail=:UsuarioEmail, UsuarioNombre=:UsuarioNombre, 
            UsuarioEst=:UsuarioEst, UsuarioActCod=:UsuarioActCod, UsuarioTipo=:UsuarioTipo WHERE UsuarioId=:UsuarioId";

            return self::executeNonQuery($sqlIns, $usuario);
        }

        static public function updateUsuarioWithPswdAdmin($UsuarioId, $UsuarioEmail, $UsuarioNombre, $UsuarioPswd, 
        $UsuarioEst, $UsuarioTipo)
        {
            if (!\Utilities\Validators::IsValidEmail($UsuarioEmail)) 
            {
                throw new Exception("Correo no es válido");
            }
            
            if (!\Utilities\Validators::IsValidPassword($UsuarioPswd)) 
            {
                throw new Exception("Contraseña debe ser almenos 8 caracteres, 1 número, 1 mayúscula, 1 símbolo especial");
            }      
            
            $usuario = self::_usuarioStruct();
            //Tratamiento de la Contraseña
            $hashedPassword = self::_hashPassword($UsuarioPswd);

            unset($usuario["UsuarioFching"]);
            unset($usuario["UsuarioPswdChg"]);

            $usuario["UsuarioId"] = $UsuarioId;
            $usuario["UsuarioEmail"] = $UsuarioEmail;
            $usuario["UsuarioNombre"] = $UsuarioNombre;
            $usuario["UsuarioPswd"] = $hashedPassword;
            $usuario["UsuarioPswdEst"] = Estados::ACTIVO;
            $usuario["UsuarioPswdExp"] = date('Y-m-d', time() + 7776000);  //(3*30*24*60*60) (m d h mi s)
            $usuario["UsuarioEst"] = $UsuarioEst;
            $usuario["UsuarioActCod"] = hash("sha256", $UsuarioEmail.time());
            $usuario["UsuarioTipo"] = $UsuarioTipo;

            $sqlIns = "UPDATE `usuarios` SET `UsuarioEmail`=:UsuarioEmail, `UsuarioNombre`=:UsuarioNombre, 
            `UsuarioPswd`=:UsuarioPswd, `UsuarioPswdEst`=:UsuarioPswdEst, `UsuarioPswdExp`=:UsuarioPswdExp, 
            `UsuarioEst`=:UsuarioEst, `UsuarioActCod`=:UsuarioActCod, `UsuarioPswdChg`=now(), `UsuarioTipo`=:UsuarioTipo
            WHERE UsuarioId=:UsuarioId;";
            return self::executeNonQuery($sqlIns, $usuario);
        }

        public static function deleteUsuarioAdmin($UsuarioId)
        {
            $delsql = "DELETE FROM usuarios WHERE UsuarioId=:UsuarioId;";
            return self::executeNonQuery
            (
                $delsql,
                array("UsuarioId" => $UsuarioId)
            );
        }

        public static function getUsuariobyId($UsuarioId)
        {
            $sqlstr = "SELECT * FROM usuarios WHERE UsuarioId = :UsuarioId LIMIT 1;";
            return self::obtenerUnRegistro($sqlstr, array("UsuarioId"=>$UsuarioId));
        }

        static public function getUsuarioByEmail($UsuarioEmail)
        {
            $sqlstr = "SELECT * FROM `usuarios` where `UsuarioEmail` = :UsuarioEmail ;";
            $params = array("UsuarioEmail"=>$UsuarioEmail);

            return self::obtenerUnRegistro($sqlstr, $params);
        }

        public static function getUsuarioDifferbyEmail($UsuarioId, $UsuarioEmail)
        {
            $sqlstr = "SELECT * FROM usuarios WHERE UsuarioId!=:UsuarioId AND UsuarioEmail=:UsuarioEmail";
            return self::obtenerRegistros($sqlstr, array("UsuarioId"=>$UsuarioId, "UsuarioEmail"=>$UsuarioEmail));
        }
        
        static private function _saltPassword($UsuarioPswd)
        {
            return hash_hmac(
                "sha256",
                $UsuarioPswd,
                \Utilities\Context::getContextByKey("PWD_HASH")
            );
        }

        static private function _hashPassword($password)
        {
            return password_hash(self::_saltPassword($password), PASSWORD_ALGORITHM);
        }

        static public function verifyPassword($raw_password, $hash_password)
        {
            return password_verify(
                self::_saltPassword($raw_password),
                $hash_password
            );
        }

        static private function _usuarioStruct()
        {
            return array(
                "UsuarioId"      => "",
                "UsuarioEmail"    => "",
                "UsuarioNombre"     => "",
                "UsuarioPswd"     => "",
                "UsuarioFching"   => "",
                "UsuarioPswdEst"  => "",
                "UsuarioPswdExp"  => "",
                "UsuarioEst"      => "",
                "UsuarioActCod"   => "",
                "UsuarioPswdChg"  => "",
                "UsuarioTipo"     => "",
            );
        }

        static public function getFeature($FuncionId)
        {
            $sqlstr = "SELECT * FROM funciones WHERE FuncionId=:FuncionId;";
            $featuresList = self::obtenerRegistros($sqlstr, array("FuncionId"=>$FuncionId));
            return count($featuresList) > 0;
        }

        static public function addNewFeature($FuncionId, $FuncionDsc, $FuncionEst, $FuncionTipo)
        {
            $sqlins = "INSERT INTO `funciones` (`FuncionId`, `FuncionDsc`, `FuncionEst`, `FuncionTipo`)
                VALUES (:FuncionId , :FuncionDsc , :FuncionEst , :FuncionTipo);";

            return self::executeNonQuery(
                $sqlins,
                array(
                    "FuncionId" => $FuncionId,
                    "FuncionDsc" => $FuncionDsc,
                    "FuncionEst" => $FuncionEst,
                    "FuncionTipo" => $FuncionTipo
                )
            );
        }

        static public function getFeatureByUsuario($UsuarioId, $FuncionId)
        {
            $sqlstr = "SELECT * from funcionesroles a INNER JOIN rolesusuarios b ON a.RolId = b.RolId 
            WHERE a.FuncionRolEst = 'ACT' AND b.UsuarioId=:UsuarioId AND a.FuncionId=:FuncionId LIMIT 1;";
            $resultados = self::obtenerRegistros(
                $sqlstr,
                array(
                    "UsuarioId"=> $UsuarioId,
                    "FuncionId" => $FuncionId
                )
            );
            return count($resultados) > 0;
        }

        static public function getRol($RolId)
        {
            $sqlstr = "SELECT * FROM roles WHERE RolId=:RolId;";
            $featuresList = self::obtenerRegistros($sqlstr, array("RolId" => $RolId));
            return count($featuresList) > 0;
        }

        static public function addNewRol($RolId, $RolDsc, $RolEst)
        {
            $sqlins = "INSERT INTO `roles` (`RolId`, `RolDsc`, `RolEst`)
            VALUES (:RolId, :RolDsc, :RolEst);";

            return self::executeNonQuery(
                $sqlins,
                array(
                    "RolId" => $RolId,
                    "RolDsc" => $RolDsc,
                    "RolEst" => $RolEst
                )
            );
        }
        
        static public function getRolesByUsuario($UsuarioId, $RolId)
        {
            $sqlstr = "SELECT * FROM roles a INNER JOIN 
            rolesusuarios b ON a.RolId = b.RolId WHERE a.RolEst = 'ACT'
            AND b.UsuarioId=:UsuarioId AND a.RolId=:RolId LIMIT 1;";
            $resultados = self::obtenerRegistros(
                $sqlstr,
                array(
                    "UsuarioId" => $UsuarioId,
                    "RolId" => $RolId
                )
            );
            return count($resultados) > 0;
        }

        static public function getFuncionesByRolesUsuario($UsuarioId, $RolId)
        {
            $sqlstr = "SELECT * FROM roles a INNER JOIN 
            rolesusuarios b ON a.RolId = b.RolId WHERE a.RolEst = 'ACT'
            AND b.UsuarioId=:UsuarioId AND a.RolId=:RolId LIMIT 1;";
            $resultados = self::obtenerRegistros(
                $sqlstr,
                array(
                    "UsuarioId" => $UsuarioId,
                    "RolId" => $RolId
                )
            );
            return count($resultados) > 0;
        }

        static public function searchUsuarios($UsuarioBusqueda)
        {
            $sqlstr = "SELECT * FROM usuarios WHERE UsuarioEmail LIKE :UsuarioBusqueda
            OR UsuarioNombre LIKE :UsuarioBusqueda OR UsuarioFching LIKE :UsuarioBusqueda 
            OR UsuarioPswdEst LIKE :UsuarioBusqueda OR UsuarioPswdExp LIKE :UsuarioBusqueda 
            OR UsuarioEst LIKE :UsuarioBusqueda OR UsuarioTipo LIKE :UsuarioBusqueda ORDER BY UsuarioTipo;";
            
            return self::obtenerRegistros($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%"));
        }

        private function __construct()
        {

        }
        private function __clone()
        {

        }
    }
?>
