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
            $thisClass['component'] = "../app/View/components/";
            $thisClass['extension'] = ".phtml";
            
            if(file_exists($thisClass['component']."$atualClass/$component".$thisClass['extension'])){
                require_once $thisClass['component']."$atualClass/$component".$thisClass['extension'];

            }else if(file_exists($thisClass['component']."main/$component".$thisClass['extension'])){
                require_once $thisClass['component']."main/$component".$thisClass['extension'];

            }else if(file_exists($thisClass['component']."config/$component".$thisClass['extension'])){
                require_once $thisClass['component']."config/$component".$thisClass['extension'];

            }else{
                require_once "../app/View/pages/Configs/404Error".$thisClass['extension'];

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
        if(!isset($_SESSION['auth'])){
            $msg = Container::getModel('Message');
            $msg->setMessage('Voc?? precisa est?? logado para ter acesso a p??gina restrita','danger','/access');
        }
        if(!$_SESSION['auth']){
            $msg = Container::getModel('Message');
            $msg->setMessage('Voc?? precisa est?? logado para ter acesso a p??gina restrita','danger','/access');
        }
    }

    public function dontRestrict(){
        if(isset($_SESSION['auth']) && $_SESSION['auth']){
            $msg = Container::getModel('Message');
            $msg->setMessage('Voc?? j?? est?? logado, caso queira trocar de conta. Clique em sair','danger','/');
            exit;
        }
    }
}
