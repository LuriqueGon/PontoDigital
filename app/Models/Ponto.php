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
            $query = "SELECT * FROM `registrodeponto` WHERE colaborador_id = ? AND data LIKE ? AND pontoBatido = 0";
            $value = $this->select($query,array($this->__get('id'),$this->__get('data')."%"));

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
            $query = "SELECT hora_entrada FROM `registrodeponto` WHERE colaborador_id = ? AND `data` AND pontoBatido = 0 LIKE ? ORDER BY hora_entrada DESC";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->bindValue(2, $this->__get('data')."%");
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC)['hora_entrada'];
        }

        private function registrarSaida(){
            $query = "UPDATE `registrodeponto` SET `hora_saida`=? , `totalHorasTrabalhadas`= ? WHERE `colaborador_id`= ? AND hora_entrada = ?";
            $this->query($query, array($this->__get('hora_saida'),$this->__get('horasTotais'),$this->__get('id'),$this->__get('hora_entrada')));
        }

        private function finalizarPonto(){
            $query = "UPDATE registroDePonto SET pontoBatido = 1 WHERE colaborador_id = ? AND hora_entrada = ?";
            $this->query($query, array($this->__get('id'),$this->__get('hora_entrada')));
        }

        private function registrarPontoEmpregado(){
            $this->__set('totalPontos', $this->getAllPontos() + 1);

            $query = "UPDATE empregado SET pontos_registrados = ? WHERE id = ?";
            $this->query($query, array($this->__get('totalPontos'), $this->__get('id')));
        }

        // }

        public function PontoEntradaBatido(){
            $query = "SELECT * FROM `registrodeponto` WHERE colaborador_id = ? AND data LIKE ? AND hora_saida = NULL";
            $value = $this->select($query, array($this->__get('id'),$this->__get('data')."%"));

            if(!$value){
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
