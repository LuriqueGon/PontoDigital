<?php 

    namespace App\Controllers;

    use Exception;
    use MF\Controller\Action;
    use PHPMailer\PHPMailer\PHPMailer;
    use MF\Model\Container;

    class AuthController extends Action{

        public function access(){
            $this->render('access', 'authLay');

        }

        public function employerLogin(){
           

            $empregado = Container::getModel('Empregado');
            $empregado->__set('cod', $_POST['codEmployer']);
            $empregado->__set('pin', $_POST['pinEmployer']);

            echo '<pre>';
            var_dump($empregado);
            echo '</pre>';
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
