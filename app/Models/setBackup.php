<?php

namespace App\Models;

use MF\Model\DAO;

class SetBackup extends DAO
{

    protected $path = "../vendor/Config/backup";

    public function startBackup(){
        $itens = scandir($this->path);
        $allData = array();

        foreach ($itens as $item) {
            if(!in_array($item, array(".",".."))){
                $tableName = pathinfo($this->path. "/" .$item)['filename'];
                array_push($allData, $tableName);
                $path = $this->path. "/" . $tableName. ".csv";

                if(file_exists($path)){
                    $file = fopen($path, "r");
            
                    $headers = str_replace('', '', str_replace('|', '',explode(' | ',fgets($file))));
                    $data = array();
            
                    while($row = fgets($file)){
                        $rowData = str_replace('', '', str_replace('|', '',explode('|',$row)));
                        $rowName = array();
                        for($i = 0; $i<count($headers); $i++){
                            $rowName[$headers[$i]] = $rowData[$i];
                            $rowName['table'] = $tableName;
                        }
                        $this->insert($headers, $rowName, $tableName);
                        
                    }
            
                    fclose($file);
            
                }
                
                
    
            }
        }
        // echo "<pre>";
        // var_dump($allData);
        // echo "</pre> <br> <br>";
    }

    private function insert(Array $headers, Array $data, String $table):void{
        // echo '<pre>';
        // var_dump($headers);
        // echo '</pre>';
        $query = "INSERT INTO $table (";
        for($i = 0; $i<count($headers); $i++){
            if($i<count($headers)-1){
                $query .= $headers[$i].",";
            }else{
                $query .= $headers[$i];
            }
        }
        $query .= ") VALUES (";

        for($i = 0; $i<count($headers); $i++){
            if($i<count($headers)-1){
                $query .= "'". $data[$headers[$i]]."'".",";
            }else{
                $query .= "'".$data[$headers[$i]]."'";
            }
            
        }
        $query .= ")";
        
        $this->query($query);
    }
}