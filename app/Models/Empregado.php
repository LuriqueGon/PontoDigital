<?php

    namespace App\Models;
    use MF\Model\Container;
    use MF\Model\DAO;

    Class Empregado extends DAO{
        private $cod;
        private $pin;

        public function autentication(){
            if(!$this->haveAccount()){
                $msg = Container::getModel('Message');
                $msg->setMessage('Dados Inexistentes e/ou incoerentes','danger','back');
                
            }else{
                return $this->haveAccount();
            }

        }

        private function haveAccount(){
            $query = "SELECT empregador.codigo_empregador, empregador.nome as tipo, empregador.contato, empregado.id, empregado.pin, empregado.nome, empregado.email, empregado.perfil, empregado.permissao FROM `empregado` LEFT JOIN empregador ON empregador.id = empregado.empregador_id WHERE pin = ? AND codigo_empregador = ?";
            return $this->select($query, array($this->__get('pin'),$this->__get('cod')));
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