<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action{

        public function index(){

            if(!$_SESSION['auth']){
                header('location: /access');
            }

            $this->render('index');
        }


        

        
    }

?>