<?php

namespace App\Models;
use MF\Model\Model;

    Class modelBase extends Model{
        public function __set($attr, $value){
            $this->$attr = $value;
            return $this;
        }

        public function __get($attr){
            return $this->$attr;
        }
    }


?>