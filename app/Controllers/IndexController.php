<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action{

        public function index(){

            if(!$_SESSION['auth']){
                header('location: /access');
            }

            echo '<pre>';
            var_dump($_SESSION);
            echo '</pre>';

            $this->render('index');
        }


        

        
    }

?>