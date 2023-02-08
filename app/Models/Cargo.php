<?php

namespace App\Models;
use MF\Model\DAO;

    Class Cargo extends DAO{

        public function getAllSession():array{
            return $this->selectAll('SELECT sessão FROM `cargo` GROUP BY sessão');
        }

        public function getAllCargos(String $session):array{
            return $this->selectAll('SELECT nome_cargo, id FROM `cargo` WHERE sessão = ?', [$session]);
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