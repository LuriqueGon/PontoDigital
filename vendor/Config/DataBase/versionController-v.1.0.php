<?php 
    namespace Config;

    use MF\Model\Model;

    Class versionControllerV1 extends Model{
        public $query;
        private $createDataBase = "CREATE DATABASE pontoDigital;";


        private function createDataBase(){
            $this->query = $this->createDataBase;
            $stmt = $this->db->prepare($this->query);
            if($stmt->execute()){
                return true;
            }else{
                return false;
                die("database Dont Create");

            }
        }
    }
?>