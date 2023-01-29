<?php

namespace App\Models;

use MF\Model\Container;
use MF\Model\Model;

    Class Empregador extends Model{
        public $email;
        public $senha;

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
            $query = "SELECT * FROM empregado WHERE email = ? AND senha = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('email'));
            $stmt->bindValue(2, $this->__get('senha'));
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
    }


?>