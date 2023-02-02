<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class AdminController extends Action{
        public function getBackup(){
            $this->restrict();
            if($_SESSION['permissao'] >= 5){
                $backup = Container::getModel('GetBackup');
                $backup->startBackup();
            
                $msg = Container::getModel('message');
                $msg->setMessage("Backup salvo com sucesso", "success", "/");
                exit;
            }else{
                $msg = Container::getModel('message');
                $msg->setMessage("Você não tem acesso a essa página", "danger", "/");
                exit;
            }
        }

        public function setBackup(){
            $this->restrict();
            if($_SESSION['permissao'] >= 5){
                $backup = Container::getModel('SetBackup');
                $backup->startBackup();
            
                $msg = Container::getModel('message');
                $msg->setMessage("Backup realizado com sucesso", "success", "/");
                exit;
            }else{
                $msg = Container::getModel('message');
                $msg->setMessage("Você não tem acesso a essa página", "danger", "/");
                exit;
            }
        }

        
    }

?>