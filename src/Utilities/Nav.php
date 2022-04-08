<?php

    namespace Utilities;


    class Nav
    {
        private function __construct()
        {
            
        }

        private function __clone()
        {
            
        }
        
        public static function setNavContext()
        {
            $adminNAVIGATION = array();
            $clientNAVIGATION = array();

            $userID = \Utilities\Security::getUserId();
            $usuario = \Dao\Security\Security::getUsuariobyId($userID);

            //TODA LA NAVEGACIÓN PARA EL O LOS ADMINS
            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\Admin")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_admin",
                    "nav_icon"=>"",
                    "nav_label"=>"Inicio"
                );
            }

            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\Usuarios")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_usuarios",
                    "nav_icon"=>"",
                    "nav_label"=>"Usuarios"
                );
            }
            
            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\RolesUsuarios")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_rolesusuarios",
                    "nav_icon"=>"",
                    "nav_label"=>"Roles para Usuarios Administrativos"
                );
            }

            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\Roles")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_roles",
                    "nav_icon"=>"",
                    "nav_label"=>"Roles Administrativos"
                );
            }

            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\FuncionesRoles")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_funcionesroles",
                    "nav_icon"=>"",
                    "nav_label"=>"Funciones para Roles Administrativos"
                );
            }
            
            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\Productos")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_productos",
                    "nav_icon"=>"",
                    "nav_label"=>"Catálogo de Productos"
                );
            }

            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\Pedidos")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_pedidos",
                    "nav_icon"=>"",
                    "nav_label"=>"Pedidos Pendientes"
                );
            }

            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\Ventas")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_ventas",
                    "nav_icon"=>"",
                    "nav_label"=>"Historial de Ventas"
                );
            }

            //TODA LA NAVEGACIÓN PARA LOS CLIENTES

            if($usuario["UsuarioTipo"] === "PBL")
            {   
                $clientNAVIGATION[] = array(
                    "nav_url"=>"index.php",
                    "nav_icon"=>"fas fa-home mx-2",
                    "nav_label"=>"Inicio"
                );

                $clientNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=catalogoproductos&PageIndex=1",
                    "nav_icon"=>"fas fa-list-alt mx-2",
                    "nav_label"=>"Productos"
                );

                $clientNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=carrito",
                    "nav_icon"=>"fas fa-shopping-cart mx-2",
                    "nav_label"=>"Carrito"
                );
            }

            \Utilities\Context::setContext("ADMINNAVIGATION", $adminNAVIGATION);
            \Utilities\Context::setContext("CLIENTNAVIGATION", $clientNAVIGATION);
        } 

    }
?>