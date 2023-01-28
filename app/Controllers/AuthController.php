<?php 

    namespace App\Controllers;

    use Exception;
    use MF\Controller\Action;
    use PHPMailer\PHPMailer\PHPMailer;
    use MF\Model\Container;

    class AuthController extends Action{

        public function access(){
            if(isset($_SESSION['auth']) && $_SESSION['auth']){
                $msg = Container::getModel('Message');
                $msg->__set('type','danger');
                $msg->__set('msg','Você já está logado, caso queira trocar de conta. Clique em sair');
                $msg->setMessage();
            }
            $this->render('access', 'authLay');

        }

        public function logout(){
            session_destroy();
            header('location: /access');
        }

        public function employerLogin(){
           

            $empregado = Container::getModel('Empregado');
            $empregado->__set('cod', $_POST['codEmployer']);
            $empregado->__set('pin', $_POST['pinEmployer']);

            echo '<pre>';
            var_dump($empregado);
            echo '</pre>';

            $user = $empregado->autentication();

            if($user){
                $_SESSION['auth'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['perfil'] = $user['perfil'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['permissao'] = $user['permissao'];
                $_SESSION['empregador'] = $user['tipo'];
            }
            
            


            $msg = Container::getModel('Message');
            $msg->__set('type','success');
            $msg->__set('msg','Acesso autorizado');
            $msg->setMessage('/');     
        
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
