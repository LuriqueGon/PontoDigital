<?php

    namespace MF\Controller;

use MF\Model\Container;
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
                require_once "../app/View/pages/Configs/404Error.phtml";
            }
        }

        protected function content(){
            $atualClass =  strtolower(str_replace('Controller', '',str_replace('App\\Controllers\\', '', get_class($this)))); 
            $this->view->atualClass['Controller'] = $atualClass;
            if(file_exists("../app/View/pages/$atualClass/".$this->view->page.".phtml")){
                require_once "../app/View/pages/$atualClass/".$this->view->page.".phtml";
            }else{
                require_once "../app/View/pages/Configs/404Error.phtml";
            }
        }

        protected function loadComponent($component){
            $atualClass =  strtolower(str_replace('Controller', '',str_replace('App\\Controllers\\', '', get_class($this)))); 
            $this->view->atualClass['component'] = "../app/View/components/";
            $this->view->atualClass['extension'] = ".phtml";
            
            if(file_exists($this->view->atualClass['component']."$atualClass/$component".$this->view->atualClass['extension'])){
                require_once $this->view->atualClass['component']."$atualClass/$component".$this->view->atualClass['extension'];

            }else if(file_exists($this->view->atualClass['component']."main/$component".$this->view->atualClass['extension'])){
                require_once $this->view->atualClass['component']."main/$component".$this->view->atualClass['extension'];

            }else if(file_exists($this->view->atualClass['component']."config/$component".$this->view->atualClass['extension'])){
                require_once $this->view->atualClass['component']."config/$component".$this->view->atualClass['extension'];

            }else{
                require_once "../app/View/pages/Configs/404Error".$this->view->atualClass['extension'];

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

    public function restrict(){
        if(!$_SESSION['auth']){
            $msg = Container::getModel('Message');
            $msg->setMessage('Você precisa está logado para ter acesso a página restrita','danger','/access');
        }
    }

    public function dontRestrict(){
        if(isset($_SESSION['auth']) && $_SESSION['auth']){
            $msg = Container::getModel('Message');
            $msg->setMessage('Você já está logado, caso queira trocar de conta. Clique em sair','danger','/');
            exit;
        }
    }
}
