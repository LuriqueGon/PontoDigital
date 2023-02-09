<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action{

        public function index(){
            $this->restrict();
            
            if($_SESSION['permissao'] >= 3){
                $this->render('indexAdmin', 'adminLay');
            }else{
                $this->render('index', 'adminLay');
            }
            
            
        }


        

        
    }

?>