<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class UserController extends Action{
        public function index(){
            $this->restrict();
            if(isset($_SESSION['cod']) && !empty($_SESSION['cod'])){
                $this->render('empregado-cad', 'userLay');
            }else{
                $msg = Container::getModel('message');
                $msg->setMessage('Você não pode acessar essa página', 'danger', '/');
            }
        }

        public function getCargos(){
            $this->restrict();

            if(isset($_POST['session'])){
                $cargo = Container::getModel('cargo');
                echo json_encode($cargo->getAllCargos($_POST['session']));
            }else{
                $msg = Container::getModel('message');
                $msg->setMessage('Você não pode acessar essa página', 'danger', '/');
            }
        }
    }

?>