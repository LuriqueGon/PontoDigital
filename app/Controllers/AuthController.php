<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Model;

    class AuthController extends Action{

        public function access(){
            $this->render('access', 'authLay');
        }
    }

?>