<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Model;

    class TesteController extends Action{
        public function teste(){
            $this->render('teste', 'testeLay');
        }
    }

?>