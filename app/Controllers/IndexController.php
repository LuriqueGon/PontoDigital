<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action{

        public function index(){
            $this->render('index');
        }

        public function indexTeste(){

            $this->render('indexTeste');
            
            $message = Container::getModel('Message');
            $message->__set('message', 'Olá, Mundo!');
            echo $message->showMessage('Olá, Mundo!');
            
        }

        

        
    }

?>