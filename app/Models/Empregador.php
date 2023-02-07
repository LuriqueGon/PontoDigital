<?php

    namespace App\Models;

    use MF\Model\Container;
    use MF\Model\DAO;

    Class Empregador extends DAO{
        private $email;
        private $senha;

        public function autentication(){
            if(!$this->haveAccount()){
                echo 1;
                
                $msg = Container::getModel('Message');
                $msg->setMessage('Dados Inexistentes e/ou incoerentes','danger','back');
                
            }else{
                return $this->haveAccount();
            }

        }

        private function haveAccount(){
            $query = "SELECT * FROM empregado LEFT JOIN empregador ON empregador.id = empregado.empregador_id WHERE email = ? AND senha = ?";
            return $this->select($query, array($this->__get('email'),$this->__get('senha')));
        }

        public function __set($attr, $value){
            $this->$attr = $value;
            return $this;
        }

        public function __get($attr){
            return $this->$attr;
        }
    }


?>