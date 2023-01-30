<?php 

    namespace App\Controllers;

    use DateTime;
    use MF\Controller\Action;
    use MF\Model\Container;
    use MF\Model\Model;

    class AppController extends Action{

        public function registrarPontoEntrada(){
            
            if($_GET['timeNow']){
                $data = $_GET['timeNow'];
                $hora = explode(' ', $data)[1];
                $data = explode(' ', $data)[0];

                $ponto = Container::getModel('ponto');

                $ponto->__set('id', $_SESSION['user_id']);
                $ponto->__set('data', $data);
                $ponto->__set('hora_entrada', $hora);
                if($ponto->registrarPontoEntrada()){
                    $msg = Container::getModel('message');
                    $msg->setMessage('Ponto Registrado ás '.$hora, 'success', '/');
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
           
            if($_GET['timeNow']){
                $data = $_GET['timeNow'];
                $hora = explode(' ', $data)[1];
                $data = explode(' ', $data)[0];

                $ponto = Container::getModel('ponto');

                $ponto->__set('id', $_SESSION['user_id']);
                $ponto->__set('data', $data);
                $ponto->__set('hora_saida', $hora);
                if($ponto->registrarPontoSaida()){
                    $msg = Container::getModel('message');
                    $msg->setMessage('Saida registrada ás '.$hora, 'success', '/');
                }

            }else{
                $msg = Container::getModel('message');
                $msg->setMessage('Houve algum erro, data não definida pelo processo', 'danger', 'back');
                exit;
            }
        }
    }

?>