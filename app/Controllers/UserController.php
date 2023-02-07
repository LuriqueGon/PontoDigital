<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class UserController extends Action{
        public function index(){
            $this->render('empregado-cad', 'userLay');
        }
    }

?>