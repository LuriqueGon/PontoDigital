<?php 

    namespace App\Controllers;

    use Exception;
    use MF\Controller\Action;
    use PHPMailer\PHPMailer\PHPMailer;
    use MF\Model\Container;

    class AuthController extends Action{

        public function index(){
            $this->dontRestrict();

            $this->render('access', 'authLay');
        }

        public function logout(){
            $this->restrict();
            
            if(isset($_SESSION['auth'])){
                unset($_SESSION['auth']);
                unset($_SESSION['user_id']);
                unset($_SESSION['nome']);
                unset($_SESSION['perfil']);
                unset($_SESSION['email']);
                unset($_SESSION['permissao']);
                unset($_SESSION['empregador']);
                $msg = Container::getModel('Message');
                $msg->setMessage('Logout realizado com sucesso','success','/access');

            }
        }

        public function collaborLogin(){

            $this->dontRestrict();

            $empregado = Container::getModel('Empregado');
            $empregado->__set('cod', $_POST['codEmployer']);
            $empregado->__set('pin', $_POST['pinEmployer']);
            $user = $empregado->autentication();

            if($user){
                $_SESSION['auth'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['perfil'] = $user['perfil'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['permissao'] = $user['permissao'];
                $_SESSION['status'] = "Empregado";
                $_SESSION['pin'] = $user['pin'];

                $msg = Container::getModel('Message');
                $msg->setMessage('Acesso autorizado','success','/');
            }else{
                $msg = Container::getModel('Message');
                $msg->setMessage('Erros encontrados, tente novamente','danger','back');
            }
        }

        public function employerLogin(){
            $this->dontRestrict();

            echo '<pre>';
            var_dump($_POST);
            echo '</pre>';

            $empregador = Container::getModel('Empregador');
            $empregador->__set('email', $_POST['employerEmail']);
            $empregador->__set('senha', $_POST['employerPassword']);
            $user = $empregador->autentication();

            echo '<pre>';
            var_dump($user);
            echo '</pre>';

            if($user){
                $_SESSION['auth'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['perfil'] = $user['perfil'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['permissao'] = $user['permissao'];
                $_SESSION['status'] = "Empregador";

                $msg = Container::getModel('Message');
                $msg->setMessage('Acesso autorizado para o empregador','success','/');
            }
        }

        private function phpMailer(){

            $mail = new PHPMailer(true);
            $mail->setLanguage('pt-br');

            try {
                $mail->SMTPDebug = 0;                
                $mail->isSMTP();
                $mail->Host       = $this->view->phpMailer['host'];                     
                $mail->SMTPAuth   = true;
                $mail->Username   = $this->view->phpMailer['username'];
                $mail->Password   = $this->view->phpMailer['password'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress('joe@example.net', 'Joe User');

                $mail->isHTML(true);
                $mail->Subject = 'Here is the subject';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                // $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
