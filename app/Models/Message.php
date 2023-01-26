<?php

    namespace App\Models;
    use MF\Model\Model;

    Class Message extends Model{
        
        public $message;

        public function showMessage(String $message){
            return $this->__get('message');
        }
    }


?>