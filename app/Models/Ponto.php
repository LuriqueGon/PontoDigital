<?php

    namespace App\Models;
    use MF\Model\DAO;

    Class Ponto extends DAO{
        private $id;
        private $data;
        private $hora_entrada;
        private $hora_saida;
        private $intervalo_saida;
        private $intervalo_volta;
        private $horasTotais;
        private $totalPontos;


        // ENTRADA{
        public function registrarPontoEntrada():bool{

            if($this->IsPontoEntrada()){

                $this->baterPonto();
                return true;

            }else{
                header('location: /registrarPonto/Saida&='.$this->__get('data').' '.$this->__get('hora_entrada'));
                return false;
            }
        }

        private function IsPontoEntrada():bool{
            $query = "SELECT * FROM `registrodeponto` WHERE colaborador_id = ? AND pontoBatido = 0 ORDER BY `data` DESC LIMIT 1";
            $value = $this->select($query,array($this->__get('id')));

            if(!$value){
                return true;
            }else{
                return false;
            }
        }
        
        private function baterPonto(){
            $query = "INSERT INTO registrodeponto (data, hora_entrada, colaborador_id) VALUES (?,?,?)";
            $this->query($query, array($this->__get('data'),$this->__get('hora_entrada'),$this->__get('id')));
        }
        // }

        // SAIDA{
        public function registrarPontoSaida():bool{

            if(!$this->IsPontoEntrada()){
                $this->__set('hora_entrada', $this->getHoraEntrada());
                $horasTotais = gmdate('H:i:s', strtotime($this->__get('hora_saida')) - strtotime($this->__get('hora_entrada')) );
                $this->__set('horasTotais', $horasTotais);

                $this->RegistrarSaida();
                $this->finalizarPonto();
                $this->registrarPontoEmpregado();

                return true;
            }
        }

        private function getHoraEntrada():string{
            $query = "SELECT hora_entrada FROM `registrodeponto` WHERE colaborador_id = ? AND pontoBatido = 0 ORDER BY `data` DESC";
            return $this->select($query, [$this->__get('id')])['hora_entrada'];
        }

        private function getIdPonto():int{
            $query = "SELECT id FROM `registrodeponto` WHERE colaborador_id = ? AND pontoBatido = 0 ORDER BY `data` DESC";
            return $this->select($query, [$this->__get('id')])['id'];
        }

        private function registrarSaida(){
            $query = "UPDATE `registrodeponto` SET `hora_saida`= ? , `totalHorasTrabalhadas`= ? WHERE id = ?";

            $params = array(
                $this->__get('hora_saida'),
                $this->__get('horasTotais'),
                $this->getIdPonto()
            );
            $this->query($query, $params);
        }

        private function finalizarPonto(){
            $this->query("UPDATE registroDePonto SET pontoBatido = 1 WHERE id = ?", array($this->getIdPonto()));
        }

        private function registrarPontoEmpregado(){
            $this->__set('totalPontos', $this->getAllPontos() + 1);

            $query = "UPDATE empregado SET pontos_registrados = ? WHERE id = ?";
            $this->query($query, array($this->__get('totalPontos'), $this->__get('id')));
        }

        // }

        public function PontoEntradaBatido():bool{
            $query = "SELECT * FROM `registrodeponto` WHERE colaborador_id = ? AND data LIKE ? AND pontoBatido = 0";
            $value = $this->select($query, array($this->__get('id'),$this->__get('data')."%"));

            if($value){
                return true;
            }else{
                return false;
            }
        }

        public function getPontoBatido():bool{
            $query = "SELECT pontoBatido FROM `registrodeponto` WHERE colaborador_id = ? AND data LIKE ? AND pontoBatido = 0";
            $value = $this->select($query, array($this->__get('id'),$this->__get('data')."%"));

            if($value){
                return true;
            }else{
                return false;
            }
        }

        public function getAll($id){
            $query = "SELECT data, hora_entrada,hora_saida,intervalo_saida,intervalo_volta,totalHorasTrabalhadas FROM registrodeponto WHERE colaborador_id=?";
            return $this->selectAll($query, array($id));
        }

        private function getAllPontos():int { 
            $query = "SELECT pontos_registrados FROM `empregado` WHERE id = ? AND ativo = 1";
            return $this->select($query, array($this->__get('id')))['pontos_registrados'];
        }

        public function __set($attr, $value):void{
            $this->$attr = $value;
        }

        public function __get($attr){
            return $this->$attr;
        }
    }
