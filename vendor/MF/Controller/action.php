<?php

    namespace MF\Controller;

    abstract class Action{

        protected $view;   

        public function __construct(){
            $this->view = new \stdClass();
            session_start();
        }

        protected function render($view, $layout = 'layout'){
            $this->view->page = $view;

            if(file_exists("../app/View/layouts/$layout.phtml")){
                require_once "../app/View/layouts/$layout.phtml";
            }else{
                require_once "../app/View/Configs/404Error.phtml";
            }
        }

        protected function content(){
            $atualClass =  strtolower(str_replace('Controller', '',str_replace('App\\Controllers\\', '', get_class($this)))); 
            $this->view->atualClass['Controller'] = $atualClass;
            if(file_exists("../app/View/$atualClass/".$this->view->page.".phtml")){
                require_once "../app/View/$atualClass/".$this->view->page.".phtml";
            }else{
                require_once "../app/View/Configs/404Error.phtml";
            }
        }

        protected function loadComponents($component){
            $atualClass =  strtolower(str_replace('Controller', '',str_replace('App\\Controllers\\', '', get_class($this)))); 
            $this->view->atualClass['Component'] = $atualClass;
            if(file_exists("../app/View/components/$atualClass/$component.phtml")){
                require_once "../app/View/components/$atualClass/$component.phtml";
            }else{
                require_once "../app/View/Configs/404Error.phtml";
            }
        }
    }

?>