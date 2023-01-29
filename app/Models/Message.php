<?php

    namespace App\Models;
    use MF\Model\Model;

    Class Message extends Model{
        
        protected $type;
        public $msg;
        public $time = 1;

        public function setMessage($message, $type, $redirect = "/"){
            if(isset($message) && !empty($message)){
                $_SESSION['type'] = $type;
                $_SESSION['msg'] = $message;
                $_SESSION['time'] = $this->time;

                if($redirect == "back"){
                    header('location: '. $_SERVER['HTTP_REFERER']);
                }else{
                    header('location: '. $redirect);
                }
            }
        }
        
        public function getMessage(){
            if(!empty($_SESSION['msg'])){
                return [
                    
                    "type" => $_SESSION['type'],
                    "msg" => $_SESSION['msg'],
                    "time" => $_SESSION['time']
                ];
            }else{
                return false;
            }
        }
        public function cleanMessage(){
            $_SESSION['msg'] = "";
            $_SESSION['type'] = "";
            $_SESSION['time'] = "";
            unset($_SESSION['msg']);
            unset($_SESSION['type']);
            unset($_SESSION['time']);
        }
       
    }


?>