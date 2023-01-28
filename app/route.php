<?php

namespace App; 
use MF\Init\Bootstrap; 

    class Route extends Bootstrap{

        protected function initRoutes(){

            $routes['home'] = array(
                'route' => '/',
                'controller' => 'IndexController',
                'action' => 'index'
            );  
            
            $routes['access'] = array(
                'route' => '/access',
                'controller' => 'AuthController',
                'action' => 'access'
            );  
            
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