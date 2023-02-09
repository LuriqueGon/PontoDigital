<?php 

    namespace App\Controllers;

    use App\Models\Message;
    use MF\Controller\Action;
    use MF\Model\Container;

    class UserController extends Action{
        public function index(){
            $this->restrict();
            if(isset($_SESSION['cod']) && !empty($_SESSION['cod'])){
                if($_SESSION['permissao'] >= 5){
                    $this->render('empregado-cad-admin', 'userLay');
                }else{
                    $this->render('empregado-cad', 'userLay');
                }
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

        public function cadastrarEmpregado(){
            $this->restrict();

            // Set dados no objeto
            $empregado = Container::getModel('empregado');

            $empregado->__set('nome', $_POST['nome']);
            $empregado->__set('email', $_POST['email']);
            $empregado->__set('senha', $_POST['senha']);
            $empregado->__set('pin', $_POST['pin']);
            $empregado->__set('nascimento', $_POST['nascimento']);
            $empregado->__set('telefone', $_POST['telefone']);
            $empregado->__set('perm', $_POST['perm']);
            $empregado->__set('sessao', $_POST['sessao']);
            $empregado->__set('cargo', $_POST['cargo']);
            $empregado->__set('cod', $_POST['cod']);
            $empregado->__set('empregador_id', $_SESSION['user_id']);

            // Variaveis

            $file = $_FILES['perfil'];
            $userName = str_replace(' ', '-',$_POST['nome']);
            $path = "./img/perfil";
            $fileName = bin2hex(random_bytes(20)). '.jpg';
            $perfil = $path."/$userName/".$fileName;
            

            // Pegar foto de perfil

            echo "<pre>";
            var_dump($_POST);
            echo "</pre>";

            if(!empty($file)){
                $file['type'] = explode('/',$file['type'])[1];
                if(in_array($file['type'], ["jpeg","jpg","JPEG","JPG", "png", "PNG"])){

                    if($file['error'])Message::setInstaMessage($file['error'], 'danger', 'back');
                    if(!is_dir($path))mkdir($path);
                    if(!is_dir($path.'/'.$userName ))mkdir($path.'/'. $userName);
                    // Salva foto no servidor, e envia pro Objeto EMPREGADO
                    $empregado->__set('perfil', "$userName/".$fileName);
                    if($empregado->cadastrarEmpregado()){
                        $empregado->cadastrarCargo();
                        if(move_uploaded_file($file['tmp_name'], $perfil)){
                            Message::setInstaMessage("Cadastro realizado com sucesso", 'success', 'back');
                        }else Message::setInstaMessage("Uploud do arquivo falhou", 'danger', 'back');
                    }else{
                        Message::setInstaMessage("Dados já existentes no banco", 'danger', 'back');
                    }
                    
                }else Message::setInstaMessage("Tipo do arquivo invalido, só aceitamos JPG e PNG", 'danger', 'back');
                        

            }else Message::setInstaMessage("Arquivo inexistente", 'danger', 'back');

        }

    }
