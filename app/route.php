<?php

namespace App; 
use MF\Init\Bootstrap; 

    class Route extends Bootstrap{

        protected function initRoutes(){

            // INDEX
            $routes['home'] = array(
                'route' => '/',
                'controller' => 'IndexController',
                'action' => 'index'
            );  


            // AUTH
            $routes['access'] = array(
                'route' => '/access',
                'controller' => 'AuthController',
                'action' => 'access'
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