<?php

namespace App\Models;
use MF\Model\Model;

    Class Ponto extends Model{
        private $id;
        private $data;
        private $hora_entrada;
        private $hora_saida;
        private $intervalo_saida;
        private $intervalo_volta;
        private $horasTotais;
        private $totalPontos;


        public function registrarPontoEntrada(){

            if($this->IsPontoEntrada()){
                echo "Ponto Entrada";
                if($this->baterPonto()){
                    return true;
                }else{
                    return false;
                }
            }else{
                header('location: /registrarPonto/Saida&='.$this->data.' '.$this->hora_entrada);
            }
        }

        public function registrarPontoSaida(){

            if(!$this->IsPontoEntrada()){
                $this->__set('hora_entrada', $this->getHoraEntrada());
                $horasTotais = gmdate('H:i:s', strtotime($this->hora_saida) - strtotime($this->hora_entrada) );
                $this->__set('horasTotais', $horasTotais);

                echo "<pre>";
                var_dump($this);
                echo "</pre>";

                if($this->RegistrarSaida()){
                    $this->finalizarPonto();
                    return $this->registrarPontoEmpregado();
                }
            }else{
                header('location: /registrarPonto/Entrada&data='.$this->data.' '.$this->hora_saida);
            }

        }

        public function PontoEntradaBatido(){
            $query = "SELECT * FROM `registrodeponto` WHERE colaborador_id = ? AND data LIKE ? AND hora_saida = NULL";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->bindValue(2, $this->__get('data')."%");
            $stmt->execute();

            if(!$stmt->fetch(\PDO::FETCH_ASSOC)){
                return true;
            }else{
                return false;
            }
        }

        public function PontoSaidaBatido(){
            $query = "SELECT * FROM `registrodeponto` WHERE colaborador_id = ? AND data LIKE ? AND hora_saida != NULL";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->bindValue(2, $this->__get('data')."%");
            $stmt->bindValue(2, $this->__get('hora_saida'));
            $stmt->execute();

            if(!$stmt->fetch(\PDO::FETCH_ASSOC)){
                return true;
            }else{
                return false;
            }
        }

        public function getPontoBatido(){
            $query = "SELECT pontoBatido FROM `registrodeponto` WHERE colaborador_id = ? AND data LIKE ? AND pontoBatido = 0";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->bindValue(2, $this->__get('data')."%");
            $stmt->execute();

            if($stmt->fetch(\PDO::FETCH_ASSOC)){
                return true;
            }else{
                return false;
            }
        }

        

        private function IsPontoEntrada(){
            $query = "SELECT * FROM `registrodeponto` WHERE colaborador_id = ? AND data LIKE ? AND pontoBatido = 0";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->bindValue(2, $this->__get('data')."%");
            $stmt->execute();

            

            if(!$stmt->fetch(\PDO::FETCH_ASSOC)){
                return true;
            }else{
                return false;
            }
        }
        
        private function baterPonto(){
            $query = "INSERT INTO registrodeponto (data, hora_entrada, colaborador_id) VALUES (?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('data'));
            $stmt->bindValue(2, $this->__get('hora_entrada'));
            $stmt->bindValue(3, $this->__get('id'));
            return $stmt->execute();
        }

        private function registrarSaida(){
            $query = "UPDATE `registrodeponto` SET `hora_saida`=? , `totalHorasTrabalhadas`= ? WHERE `colaborador_id`= ? AND hora_entrada = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('hora_saida'));
            $stmt->bindValue(2, $this->__get('horasTotais'));
            $stmt->bindValue(3, $this->__get('id'));
            $stmt->bindValue(4, $this->__get('hora_entrada'));
            return $stmt->execute();
        }

        

        private function getHoraEntrada(){
            $query = "SELECT hora_entrada FROM `registrodeponto` WHERE colaborador_id = ? AND `data` AND pontoBatido = 0 LIKE ? ORDER BY hora_entrada DESC";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->bindValue(2, $this->__get('data')."%");
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC)['hora_entrada'];
        }

        private function registrarPontoEmpregado(){
            $this->__set('totalPontos', $this->getAllPontos() + 1);

            $query = "UPDATE empregado SET pontos_registrados = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('totalPontos'));
            $stmt->bindValue(2, $this->__get('id'));
            return $stmt->execute();
            
        }

        private function getAllPontos():Int { 
            $query = "SELECT pontos_registrados FROM `empregado` WHERE id = ? AND ativo = 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC)['pontos_registrados'];
        }

        private function finalizarPonto(){
            $query = "UPDATE registroDePonto SET pontoBatido = 1 WHERE colaborador_id = ? AND hora_entrada = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->bindValue(2, $this->__get('hora_entrada'));
            return $stmt->execute();
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