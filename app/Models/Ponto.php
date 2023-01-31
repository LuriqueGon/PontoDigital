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


        // ENTRADA{
        public function registrarPontoEntrada():bool{

            if($this->IsPontoEntrada()){

                $this->baterPonto();
                return true;

            }else{
                header('location: /registrarPonto/Saida&='.$this->data.' '.$this->hora_entrada);
                return false;
            }
        }

        private function IsPontoEntrada():bool{
            $stmt = $this->db->prepare("SELECT * FROM `registrodeponto` WHERE colaborador_id = ? AND data LIKE ? AND pontoBatido = 0");
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->bindValue(2, $this->__get('data')."%");
            $stmt->execute();

            if(!$stmt->fetch(\PDO::FETCH_ASSOC)){
                return true;
            }else{
                return false;
            }
        }
        
        private function baterPonto():void{
            $stmt = $this->db->prepare("INSERT INTO registrodeponto (data, hora_entrada, colaborador_id) VALUES (?,?,?)");
            $stmt->bindValue(1, $this->__get('data'));
            $stmt->bindValue(2, $this->__get('hora_entrada'));
            $stmt->bindValue(3, $this->__get('id'));
            $stmt->execute();
        }
        // }

        // SAIDA{
        public function registrarPontoSaida():bool{

            if(!$this->IsPontoEntrada()){
                $this->__set('hora_entrada', $this->getHoraEntrada());
                $horasTotais = gmdate('H:i:s', strtotime($this->hora_saida) - strtotime($this->hora_entrada) );
                $this->__set('horasTotais', $horasTotais);

                if($this->RegistrarSaida()){
                    $this->finalizarPonto();
                    return $this->registrarPontoEmpregado();
                }
            }else{
                header('location: /registrarPonto/Entrada&data='.$this->data.' '.$this->hora_saida);
                return false;
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

        private function registrarSaida():bool{
            $query = "UPDATE `registrodeponto` SET `hora_saida`=? , `totalHorasTrabalhadas`= ? WHERE `colaborador_id`= ? AND hora_entrada = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('hora_saida'));
            $stmt->bindValue(2, $this->__get('horasTotais'));
            $stmt->bindValue(3, $this->__get('id'));
            $stmt->bindValue(4, $this->__get('hora_entrada'));
            return $stmt->execute();
        }

        private function finalizarPonto():bool{
            $query = "UPDATE registroDePonto SET pontoBatido = 1 WHERE colaborador_id = ? AND hora_entrada = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->bindValue(2, $this->__get('hora_entrada'));
            return $stmt->execute();
        }

        private function registrarPontoEmpregado():bool{
            $this->__set('totalPontos', $this->getAllPontos() + 1);

            $query = "UPDATE empregado SET pontos_registrados = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('totalPontos'));
            $stmt->bindValue(2, $this->__get('id'));
            return $stmt->execute();
            
        }

        // }

        public function PontoEntradaBatido():bool{
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

        public function getPontoBatido():bool{
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

        private function getAllPontos():int { 
            $query = "SELECT pontos_registrados FROM `empregado` WHERE id = ? AND ativo = 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC)['pontos_registrados'];
        }

        public function __set($attr, $value):void{
            $this->$attr = $value;
        }

        public function __get($attr):string{
            return $this->$attr;
        }
    }
