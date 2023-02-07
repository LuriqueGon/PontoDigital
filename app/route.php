<?php

namespace App; 
use MF\Init\Bootstrap; 

    class Route extends Bootstrap{

        protected function initRoutes(){

            // INDEX
            $routes['homePage'] = array(
                'route' => '/',
                'controller' => 'IndexController',
                'action' => 'index'
            );  


            // AUTH
            $routes['accessPage'] = array(
                'route' => '/access',
                'controller' => 'AuthController',
                'action' => 'index'
            ); 

            $routes['employeLogin'] = array(
                'route' => '/auth/empregado/login',
                'controller' => 'AuthController',
                'action' => 'collaborLogin'
            ); 
             
            $routes['employerLogin'] = array(
                'route' => '/auth/empregador/login',
                'controller' => 'AuthController',
                'action' => 'employerLogin'
            ); 
             
            
            $routes['logout'] = array(
                'route' => '/logout',
                'controller' => 'AuthController',
                'action' => 'logout'
            ); 

            // PONTO
            $routes['pontoPage'] = array(
                'route' => '/registrarPonto',
                'controller' => 'AppController',
                'action' => 'index'
            );
            $routes['registrarPonto'] = array(
                'route' => '/registrarPonto/Entrada',
                'controller' => 'AppController',
                'action' => 'registrarPontoEntrada'
            ); 
            $routes['registrarPontoSaida'] = array(
                'route' => '/registrarPonto/Saida',
                'controller' => 'AppController',
                'action' => 'registrarPontoSaida'
            ); 
            
            
            // ADMIN
            $routes['getBackup'] = array(
                'route' => '/getBackup',
                'controller' => 'AdminController',
                'action' => 'getBackup'
            ); 
            $routes['setBackup'] = array(
                'route' => '/setBackup',
                'controller' => 'AdminController',
                'action' => 'setBackup'
            ); 
            

            // USER
            $routes['cadastrarEmpregadoPage'] = array(
                'route' => '/auth/cadastrar/empregado',
                'controller' => 'UserController',
                'action' => 'index'
            );  

            // TESTE
            $routes['teste'] = array(
                'route' => '/teste',
                'controller' => 'TesteController',
                'action' => 'teste'
            );  
            

            
            
            /*
            $routes['NomeDaRota'] = array(
                'route' => '/EndereçoDaRota',
                'controller' => 'NomeDoController',
                'action' => 'MétodoDentroDoController'
            );  
            */
            
            

            $this->setRoutes($routes);
        }

        
    }

?>