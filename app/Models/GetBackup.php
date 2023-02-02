<?php

namespace App\Models;
use MF\Model\DAO;

    Class GetBackup extends DAO{

        public function backupCargos(){
            $cargos = $this->getTable("cargo");
            $headers = $this->setHeaders($cargos);
            $path = "../vendor/Config/backup";
        
            if(!is_dir($path))mkdir($path);
        
            $file = fopen("$path/cargos.csv", "w+");

            fwrite($file,implode(' | ', $headers). "\n");
        
            $this->setData($cargos, $file);
            fclose($file);
        }

        public function backupCargosEmpregados(){
            $cargos_empregados = $this->getTable("cargo_empregado");
            $headers = $this->setHeaders($cargos_empregados);
            $path = "../vendor/Config/backup";
        
            if(!is_dir($path))mkdir($path);
        
            $file = fopen("$path/cargos_empregados.csv", "w+");

            fwrite($file,implode(' | ', $headers). "\n");
        
            $this->setData($cargos_empregados, $file);
            fclose($file);
        }

        public function backupEmpregados(){
            $empregados = $this->getTable("empregado");
            $headers = $this->setHeaders($empregados);
            $path = "../vendor/Config/backup";
        
            if(!is_dir($path))mkdir($path);
        
            $file = fopen("$path/empregados.csv", "w+");

            fwrite($file,implode(' | ', $headers). "\n");
        
            $this->setData($empregados, $file);
            fclose($file);
        }

        public function backupEmpregadores(){
            $empregadores = $this->getTable("empregador");
            $headers = $this->setHeaders($empregadores);
            $path = "../vendor/Config/backup";
        
            if(!is_dir($path))mkdir($path);
        
            $file = fopen("$path/empregadores.csv", "w+");

            fwrite($file,implode(' | ', $headers). "\n");
        
            $this->setData($empregadores, $file);
            fclose($file);
        }

        public function backupRegistroDePonto(){
            $registroDePonto = $this->getTable("registrodeponto");
            $headers = $this->setHeaders($registroDePonto);
            $path = "../vendor/Config/backup";
        
            if(!is_dir($path))mkdir($path);
        
            $file = fopen("$path/registroDePonto.csv", "w+");

            fwrite($file,implode(' | ', $headers). "\n");
        
            $this->setData($registroDePonto, $file);
            fclose($file);
        }

        
        

        private function getTable(String $table){
            $query = "SELECT * FROM $table";
            return $this->selectAll($query);
            
        }

        private function setHeaders(Array $array):array{
            $headers = array();
            foreach ($array[0] as $key => $value) {
                array_push($headers,ucfirst($key));
            }
            return $headers;
        }

        private function setData(Array $data, $file){
            foreach ($data as $row) {
                $data = array();
        
                foreach ($row as $value) {
                    array_push($data, $value);
                }

                fwrite($file, implode(' | ', $data). "\n");
            }
        }
    }
