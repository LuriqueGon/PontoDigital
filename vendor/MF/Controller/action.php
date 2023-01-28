<?php

    namespace MF\Controller;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    abstract class Action{

        protected $view;   

        public function __construct(){
            $this->view = new \stdClass();
            session_start();
            $this->phpMailerStart();
            $this->defineConst();
            
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

        protected function loadComponent($component){
            $atualClass =  strtolower(str_replace('Controller', '',str_replace('App\\Controllers\\', '', get_class($this)))); 
            $this->view->atualClass['Component'] = $atualClass;
            
            if(file_exists("../app/View/components/$atualClass/$component.phtml")){
                require_once "../app/View/components/$atualClass/$component.phtml";
            }else if(file_exists("../app/View/components/main/$component.phtml")){
                require_once "../app/View/components/main/$component.phtml";
            }else{
                require_once "../app/View/Configs/404Error.phtml";
            }
        }

    private function phpMailerStart(){
        $this->view->phpMailer['host'] = "example@gmail.com";
        $this->view->phpMailer['username'] = "user@gmail.com";
        $this->view->phpMailer['password'] = "123";
    }

    private function defineConst(){
        define("VERSION", 'v-1.0.0');
    }
}
