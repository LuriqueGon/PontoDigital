<?php

namespace App\Models;

use MF\Model\Container;
use MF\Model\Model;

    Class Empregado extends Model{
        public $cod;
        public $pin;

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
            $query = "SELECT empregador.codigo_empregador, empregador.nome as tipo, empregador.contato, empregado.id, empregado.pin, empregado.nome, empregado.email, empregado.perfil, empregado.permissao FROM `empregado` LEFT JOIN empregador ON empregador.id = empregado.empregador_id WHERE pin = ? AND codigo_empregador = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('pin'));
            $stmt->bindValue(2, $this->__get('cod'));
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
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