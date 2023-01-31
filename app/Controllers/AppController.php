<?php 

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class AppController extends Action{
        
        public function index(){
            $this->restrict();

            $this->render('ponto', 'pontoLay');
        }

        public function registrarPontoEntrada(){
            $this->restrict();

            if($_GET['timeNow']){

                $data = $_GET['timeNow'];
                $data = explode(' ', $data);
                $hora = $data[1];
                $data = $data[0];

                $ponto = Container::getModel('ponto');

                $ponto->__set('id', $_SESSION['user_id']);
                $ponto->__set('data', $data);
                $ponto->__set('hora_entrada', $hora);

                if($ponto->registrarPontoEntrada()){
                    $msg = Container::getModel('message');
                    $msg->setMessage('Ponto Registrado ás '.$hora, 'success', '/registrarPonto');
                    exit;
                    
                }else{
                    $msg = Container::getModel('message');
                    $msg->setMessage('Houve algum erro, data não definida pelo processo', 'danger', 'back');
                    exit;
                }

            }else{
                $msg = Container::getModel('message');
                $msg->setMessage('Houve algum erro, data não definida pelo processo', 'danger', 'back');
                exit;

            }
        }

        public function registrarpontoSaida(){
            $this->restrict();

            if($_GET['timeNow']){
                
                $data = $_GET['timeNow'];
                $data = explode(' ', $data);
                $hora = $data[1];
                $data = $data[0];

                $ponto = Container::getModel('ponto');

                $ponto->__set('id', $_SESSION['user_id']);
                $ponto->__set('data', $data);
                $ponto->__set('hora_saida', $hora);

                if($ponto->registrarPontoSaida()){
                    $msg = Container::getModel('message');
                    $msg->setMessage('Saida registrada ás '.$hora, 'success', '/registrarPonto');
                    exit;

                }else{
                    $msg = Container::getModel('message');
                    $msg->setMessage('Houve algum erro, data não definida pelo processo', 'danger', 'back');
                    exit;

                }

            }else{
                $msg = Container::getModel('message');
                $msg->setMessage('Houve algum erro, data não definida pelo processo', 'danger', 'back');
                exit;

            }
        }
    }

?>