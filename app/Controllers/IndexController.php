<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action{

        public function index(){
            $this->restrict();
            if(isset($_SESSION['permissao']) && $_SESSION['permissao'] >= 3){
                $this->render('indexAdmin');
            }else{
                $this->render('index');
            }
        }


        

        
    }

?>