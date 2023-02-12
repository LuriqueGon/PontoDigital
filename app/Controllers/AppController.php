<?php 

    namespace App\Controllers;

    use App\Models\Message;
    use MF\Controller\Action;
    use MF\Model\Container;

    class AppController extends Action{
        
        public function index(){
            $this->restrict();

            $this->render('ponto', 'pontoLay');
        }
        public function relatorioDePontos(){
            $this->restrict();

            $this->render('relatorioDePontos', 'relatorioLay');
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
                    Message::setInstaMessage('Ponto Registrado ás '.$hora, 'success', '/registrarPonto');
                }else Message::setInstaMessage('Houve algum erro, data não definida pelo processo', 'danger', 'back');

            }else Message::setInstaMessage('Houve algum erro, data não definida pelo processo', 'danger', 'back');
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
                    Message::setInstaMessage('Saida registrada ás '.$hora, 'success', '/registrarPonto');

                }else Message::setInstaMessage('Houve algum erro, data não definida pelo processo', 'danger', 'back');

            }else Message::setInstaMessage('Houve algum erro, data não definida pelo processo', 'danger', 'back');
        }
    }

?>