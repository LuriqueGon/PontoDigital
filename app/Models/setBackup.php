<?php

namespace App\Models;

use Exception;
use MF\Model\DAO;
use ResourceBundle;

class SetBackup extends DAO{

    protected $path = "../vendor/Config/backup";
    public function startBackup(){
        $order = [
            "cargo",
            "empregador",
            "empregado",
            "cargo_empregado",
            "registrodeponto"
        ]; 
        foreach ($order as $key => $table) {

            $path = $this->path."/".$table.".csv";
            if(file_exists($path)){

                $file = fopen($path, "r");
                $headers = $this->getHeaders($file);

                while($row = fgets($file)){
                    $data = array();
                    $rowData = $this->getData($row);

                    for($i = 0; $i<count($headers); $i++)array_push($data, $rowData[$i]);

                    $query = $this->setQuery($table,$headers, $data);
                    // echo $query;
                    // echo "<br> <br> <br> <br> <hr>";
                    try{

                        $this->query($query);
                    }catch(Exception $e){
                        if($e->getCode() == 23000){
                            exit;
                        }
                    }
                }

                fclose($file);
            }
        }
    }


    private function setQuery(String $table, Array $headers, Array $datas):string{
        $query = $this->getParams($table, $datas, $headers);
        
        return $query;
    }

    private function getParams (String $table, Array $datas, Array $params):String{
        $query = "INSERT INTO $table (";
        foreach($params as $key => $value){
            if($key < count($params)-1){
                $query .= $value. "," ;
            }else{
                $query .= $value;
            }
        }
        return $this->getDatas($query, $datas);
    }

    private function getDatas(String $query, Array $datas):String{
        $query .= ") VALUES (";
        foreach($datas as $key => $value){
            if($key < count($datas)-1){
                $query .= "'".$value."'". "," ;
            }else{
                $query .= "'".$value."'";
            }
        }
        $query .= ")";

        return $query;
    }
    
    private function getHeaders($file):array{
        return str_replace('', '', str_replace('|', '',explode(' | ',fgets($file))));
    }

    private function getData($row):array{
        return str_replace('', '', str_replace('|', '',explode('|',$row)));
    }
}
