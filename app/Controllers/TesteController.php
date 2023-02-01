<?php 

    namespace App\Controllers;
    use MF\Controller\Action;

    class TesteController extends Action{
        public function teste(){
            $this->restrict();
            $this->render('teste', 'testeLay');
        }
    }

?>